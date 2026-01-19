<?php

namespace App\Services;


use Closure;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Log;

class Bitrix24Service
{
    protected ?string $webhookUrl = null;
    protected $paidMemberTypeId;

    public function __construct()
    {
        $this->paidMemberTypeId = config('services.bitrix.paid_member_type_id');
    }
    public function useWebhook(string $name): self
    {
        $webhooks = [
            'crm' => 'https://klub.bitrix24.pl/rest/46/6a1cvhws1h99k4ku/'
        ];


        $webhook = $webhooks[$name] ?? null;

        if (!$webhook) {
            throw new Exception("Webhook o nazwie '{$name}' nie został znaleziony w bazie danych.");
        }

        $this->webhookUrl = $webhook;

        return $this;
    }

    public function processInChunks(string $method, array $params, Closure $callback): int
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $totalProcessed = 0;
        $start = 0;

        do {
            $response = Http::withoutVerifying()->post($this->webhookUrl . $method, array_merge($params, ['start' => $start]));

            if (!$response->successful()) {
                Log::error("Bitrix API call failed for method {$method}", ['response' => $response->body()]);
                break;
            }

            $data = $response->json();
            $results = $data['result'] ?? [];

            if (!empty($results)) {
                $items = is_array(reset($results)) ? $results : [$results];

                // Execute the callback function with the current chunk of data.
                $callback($items);

                $totalProcessed += count($items);
                Log::info("Processed {$totalProcessed} records for {$method}...");
            }

            $start = $data['next'] ?? -1;

            // A small delay to respect API rate limits.
            usleep(500000); // 0.5 sekundy

        } while ($start !== -1);

        return $totalProcessed;
    }

    public function getClubIdByDepartment(array $departments): array
    {

        if (is_null($this->webhookUrl))
        {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $fields = $this->useWebhook('company_fields')->getFields('crm.company.fields.json');

        $clubField = $fields['UF_CRM_1738673784']['items'];
        $clubFieldByValue = [];

        foreach ($clubField as $field)
        {
            $clubFieldByValue[mb_strtolower($field['VALUE'])] = $field['ID'];
        }

        $mappedFields = [];

        foreach($departments as $department)
        {
            $department_name = $department['title'];
            $parent_id = $department['data']['PARENT'];


            $parent = $this->useWebhook('departments_get')->getDepartmentById($parent_id);

            if(!$parent)
                return false;

            $full_name = mb_strtolower($department_name . ' - ' . $parent['name']);

            if(isset($clubFieldByValue[$full_name]))
                $mappedFields[$department['id']] = $clubFieldByValue[$full_name];
        }

        return $mappedFields;

    }

    public function getDepartmentById($id)
    {
        if (is_null($this->webhookUrl))
        {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl . 'im.department.get', ['ID' => [$id]]);

        if (empty($response->json())) {
            return [];
        }

        $responseData = $response->json()['result'];
        if(count($responseData) > 0)
            return $responseData[0];
        return [];
    }

    /**
     * Fetches all records from a paginated Bitrix24 list method.
     *
     * @param string $method
     * @param array $params
     * @return array
     */
    public function fetchAll(string $method, array $params = []): array
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $allResults = [];
        $start = 0;

        do {
            $response = Http::withoutVerifying()->post($this->webhookUrl . $method, array_merge($params, ['start' => $start]));

            if (!$response->successful()) {
                Log::error("Bitrix API call failed for method {$method}", ['response' => $response->body()]);
                break; // Exit loop on failure
            }

            $data = $response->json();

            if (!empty($data['result'])) {
                // Handle cases where the result is not an array of items
                $results = is_array(reset($data['result'])) ? $data['result'] : [$data['result']];
                $allResults = array_merge($allResults, $results);
            }

            $start = $data['next'] ?? -1;

        } while ($start !== -1);

        return $allResults;
    }

    /**
     * Get all companies.
     */
    public function getCompanies($filter = []): array
    {
        return $this->fetchAll('crm.company.list.json', ['select' => ['*', 'UF_*','EMAIL'],'filter' => $filter]);
    }




    /**
     * Get all contacts.
     */
    public function getContacts($params = []): array
    {
        return $this->fetchAll('crm.contact.list.json', ['select' => ['*', 'UF_*'],'filter' => $params]);
    }

    /**
     * Get all deals.
     */
    public function getDeals($params = []): array
    {
        return $this->fetchAll('crm.deal.list.json', ['select' => ['*', 'UF_*'],'filter' => $params]);
    }

    /**
     * Get field definitions for a given entity type.
     *
     * @param string $method (e.g., 'crm.company.fields.json')
     * @return array
     */
    public function getFields(string $method, array $filter = []): array
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl . $method,['filter' => $filter]);

        return $response->json('result', []);
    }

    public function getEntityById(int $id,int $entityTypeId): array
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl . 'crm.item.get.json', [
            'id' => $id,
            'entityTypeId' => $entityTypeId,
        ]);

        return $response->json('result.item', []);
    }

    public function getEntities(int $entityTypeId, array $filter = [], array $select = ['*']): array
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $allEntities = [];
        $start = 0;
        $hasMore = true;

        while ($hasMore) {
            $response = Http::withoutVerifying()->post($this->webhookUrl . 'crm.item.list.json', [
                'entityTypeId' => $entityTypeId,
                'filter'       => $filter,
                'select'       => $select,
                'start'        => $start,
            ]);

            $result = $response->json();

            $items = $result['result']['items'] ?? [];
            $allEntities = array_merge($allEntities, $items);

            if (isset($result['next'])) {
                $start = $result['next'];

                usleep(500000);
            } else {
                $hasMore = false;
            }
        }

        return $allEntities;
    }

    public function updateEntity(array $fields , int $id, int $entityTypeId):bool
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl . 'crm.item.update.json', ['fields' => $fields,'id' => $id,'entityTypeId' => $entityTypeId]);

        if(!$response->successful() || empty($response->json()))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function addEntity(array $fields, int $entityTypeId)
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }
        $response = Http::withoutVerifying()->post(
            $this->webhookUrl . 'crm.item.add.json',
            [
                'fields' => $fields,
                'entityTypeId' => $entityTypeId
            ]
        );

        if(!$response->successful() || empty($response->json()))
        {
            return false;
        }

        return $response->json()['result'];
    }

    public function getStatusValues(string $entityId): array
    {

        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl .'crm.status.list.json', [
            'filter' => [
                'ENTITY_ID' => $entityId
            ],
            'order' => [
                'SORT' => 'ASC'
            ]
        ]);

        if (empty($response->json())) {
            return [];
        }

        $responseData = $response->json()['result'];

        return array_map(function ($status) {
            return [
                'ID' => $status['STATUS_ID'],
                'VALUE' => $status['NAME'],
            ];
        }, $responseData);
    }

    public function getCompanyFieldsValues(): ?array
    {
        if(is_null($this->webhookUrl))
        {
            throw new Exception('Nie wybrano webhooka. użyj metody useWebhook()');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl .'crm.company.fields.json', [

        ]);

        if(!$response->successful() || empty($response->json()))
        {
            return null;
        }

        $fieldsData = $response->json('result');

        return $fieldsData;

    }

    public function updateCompany(array $data , int $id) : int
    {
        if(is_null($this->webhookUrl))
        {
            throw new Exception('Nie wybrano webhooka. użyj metody useWebhook()');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl .'crm.company.update.json', [
            'FIELDS' => $data,
            'ID' => $id,
        ]);
        if(!$response->successful() || empty($response->json()))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function createCompany($data):int
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl . 'crm.company.add.json', ['fields' => $data]);

        if(!$response->successful() || empty($response->json())) return 0;

        return $response->json()['result'];

    }

    public function updateContact(array $data , int $id) : int
    {
        if(is_null($this->webhookUrl))
        {
            throw new Exception('Nie wybrano webhooka. użyj metody useWebhook()');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl .'crm.contact.update.json', [
            'FIELDS' => $data,
            'ID' => $id,
        ]);
        if(!$response->successful() || empty($response->json()))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function createContact($data):int
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl . 'crm.contact.add.json', ['fields' => $data]);

        if(!$response->successful() || empty($response->json())) return 0;

        return $response->json()['result'];
    }

    public function createDeal($data):int
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception('Webhook not selected. Use the useWebhook() method first.');
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl . 'crm.deal.add.json', ['fields' => $data]);

        if(!$response->successful() || empty($response->json())) return 0;

        return $response->json()['result'];
    }

    public function findPaidMemberCompanyByEmail(string $email): ?array
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception("Nie wybrano webhooka. Użyj metody useWebhook() przed wykonaniem zapytania.");
        }

        $response = Http::withoutVerifying()->post($this->webhookUrl . 'crm.company.list.json', [
            'FILTER' => [
                'EMAIL' => $email,
            ],
            'SELECT' => ['*', 'UF_*','EMAIL','PHONE']
        ]);


        if (!$response->successful() || empty($response->json('result'))) {
            return null;
        }



        $companyData = $response->json('result')[0];


        $contactResponse = Http::withoutVerifying()->post($this->useWebhook('contact_list')->webhookUrl . 'crm.contact.list.json', [
            'FILTER' => [
                'COMPANY_ID' => $companyData['ID']
            ]
        ]);


        if (!$contactResponse->successful()) {
            return null;
        }

        $contactData = $contactResponse->json('result')[0];

        return [
            'company' => $companyData,
            'contact' => $contactData,
        ];
    }

    public function getDepartments(int $id = null, $filter = []): ?array
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception("Nie wybrano webhooka. Użyj metody useWebhook() przed wykonaniem zapytania.");
        }

        $allDepartments = [];

        $start = 0;

        do {
            $response = Http::withoutVerifying()->post($this->webhookUrl . 'department.get.json', [
                'SELECT' => ['*', 'UF_*'],
                'start' => $start,
                'id' => $id
            ]);

            if (!$response->successful()) {
                return $allDepartments ?: null;
            }

            $data = $response->json();

            if (!empty($data['result'])) {
                $allDepartments = array_merge($allDepartments, $data['result']);
            }

            if (isset($data['next'])) {
                $start = $data['next'];
            } else {
                $start = -1;
            }

        } while ($start !== -1);

        return $allDepartments;
    }

    public function getBitrixWorkers(array $filter = []): ?array
    {
        if (is_null($this->webhookUrl)) {
            throw new Exception("Nie wybrano webhooka. Użyj metody useWebhook() przed wykonaniem zapytania.");
        }

        $allWorkers = [];
        $start = 0;

        do {
            $payload = [
                'FILTER' => $filter,
                'SELECT' => ['*', 'UF_*'],
                'start' => $start
            ];

            $response = Http::withoutVerifying()->post($this->webhookUrl . 'user.get.json', $payload);

            if (!$response->successful()) {
                return $allWorkers ?: null;
            }

            $data = $response->json();

            if (!empty($data['result'])) {
                $allWorkers = array_merge($allWorkers, $data['result']);
            }

            if (isset($data['next'])) {
                $start = $data['next'];
            } else {
                $start = -1;
            }

        } while ($start !== -1);

        return $allWorkers;
    }
}
