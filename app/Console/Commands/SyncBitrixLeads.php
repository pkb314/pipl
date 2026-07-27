<?php

namespace App\Console\Commands;

use App\Models\Lead;
use App\Services\Bitrix24Service;
use Illuminate\Console\Command;

class SyncBitrixLeads extends Command
{
    protected $signature = 'bitrix:sync {--dry-run : Pokaż dane bez zapisu}';
    protected $description = 'Pobierz zgłoszenia z Bitrix24 i zapisz do bazy danych';

    public function handle(): int
    {
        $bitrix = app(Bitrix24Service::class)->useWebhook('crm');

        $this->info('Pobieranie kontaktów z Bitrix24...');

        try {
            $contacts = $bitrix->getContacts();
        } catch (\Exception $e) {
            $this->error('Błąd połączenia z Bitrix24: ' . $e->getMessage());
            return self::FAILURE;
        }

        $this->info("Pobrano " . count($contacts) . " kontaktów.");

        $this->info('Pobieranie deali (zgłoszeń) z Bitrix24...');

        try {
            $deals = $bitrix->getEntities(1140);
        } catch (\Exception $e) {
            $this->error('Błąd pobierania deali: ' . $e->getMessage());
            return self::FAILURE;
        }

        $this->info("Pobrano " . count($deals) . " deali.");

        $contactsMap = [];
        foreach ($contacts as $contact) {
            $contactsMap[$contact['ID']] = $contact;
        }

        $imported = 0;
        $skipped = 0;
        $updated = 0;

        $bar = $this->output->createProgressBar(count($deals));
        $bar->start();

        foreach ($deals as $deal) {
            $bar->advance();

            $contactId = $deal['contactId'] ?? $deal['CONTACT_ID'] ?? null;

            if (!$contactId || !isset($contactsMap[$contactId])) {
                $skipped++;
                continue;
            }

            $contact = $contactsMap[$contactId];

            $name = $contact['NAME'] ?? '';
            $surname = $contact['LAST_NAME'] ?? '';
            $email = '';
            if (!empty($contact['EMAIL'])) {
                $email = is_array($contact['EMAIL']) ? ($contact['EMAIL'][0]['VALUE'] ?? '') : $contact['EMAIL'];
            }
            $phone = '';
            if (!empty($contact['PHONE'])) {
                $phone = is_array($contact['PHONE']) ? ($contact['PHONE'][0]['VALUE'] ?? '') : $contact['PHONE'];
            }

            $company = $deal['ufCrm54_1768830552149'] ?? '';
            $adres = $deal['ufCrm54_1781878744225'] ?? '';
            $gmina = $deal['ufCrm54_1781878757270'] ?? '';

            if (!$name && !$surname && !$email) {
                $skipped++;
                continue;
            }

            $existing = Lead::where('bitrix_contact_id', $contactId)->first();

            if ($existing) {
                if ($this->option('dry-run')) {
                    $this->line("  Aktualizacja: {$name} {$surname} ({$email})");
                } else {
                    $existing->update([
                        'name' => $name,
                        'surname' => $surname,
                        'company' => $company,
                        'adres' => $adres,
                        'gmina' => $gmina,
                        'email' => $email,
                        'phone' => $phone,
                    ]);
                }
                $updated++;
                continue;
            }

            if ($this->option('dry-run')) {
                $this->line("  Nowy: {$name} {$surname} ({$email}) - gmina: {$gmina}");
            } else {
                Lead::create([
                    'name' => $name,
                    'surname' => $surname,
                    'company' => $company,
                    'adres' => $adres,
                    'gmina' => $gmina,
                    'email' => $email,
                    'phone' => $phone,
                    'status' => 'zgłoszone',
                    'source' => 'bitrix',
                    'bitrix_contact_id' => $contactId,
                ]);
            }
            $imported++;
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Podsumowanie:");
        $this->info("  Nowe zgłoszenia: {$imported}");
        $this->info("  Zaktualizowane: {$updated}");
        $this->info("  Pominięte: {$skipped}");

        return self::SUCCESS;
    }
}
