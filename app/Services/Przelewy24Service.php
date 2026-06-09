<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Przelewy24Service
{
    public function registerTransaction(array $payload): array
    {
        $response = $this->client()->post($this->endpoint('/api/v1/transaction/register'), $payload);

        $response->throw();

        return $response->json();
    }

    public function verifyTransaction(array $payload): array
    {
        $response = $this->client()->put($this->endpoint('/api/v1/transaction/verify'), $payload);

        $response->throw();

        return $response->json();
    }

    public function transactionUrl(string $token): string
    {
        return $this->endpoint('/trnRequest/' . $token);
    }

    public function sign(array $payload): string
    {
        return hash('sha384', json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    public function notificationSign(array $payload): string
    {
        return $this->sign([
            'merchantId' => (int) $payload['merchantId'],
            'posId' => (int) $payload['posId'],
            'sessionId' => (string) $payload['sessionId'],
            'amount' => (int) $payload['amount'],
            'originAmount' => (int) $payload['originAmount'],
            'currency' => (string) $payload['currency'],
            'orderId' => (int) $payload['orderId'],
            'methodId' => (int) $payload['methodId'],
            'statement' => (string) $payload['statement'],
            'crc' => $this->crc(),
        ]);
    }

    public function currency(): string
    {
        return config('services.przelewy24.currency', 'PLN');
    }

    public function merchantId(): int
    {
        return (int) config('services.przelewy24.merchant_id');
    }

    public function posId(): int
    {
        return (int) config('services.przelewy24.pos_id', $this->merchantId());
    }

    public function crc(): string
    {
        return (string) config('services.przelewy24.crc');
    }

    private function client(): PendingRequest
    {
        return Http::withBasicAuth(
            (string) config('services.przelewy24.pos_id', config('services.przelewy24.merchant_id')),
            (string) config('services.przelewy24.api_key')
        )->acceptJson()->asJson();
    }

    private function endpoint(string $path): string
    {
        $baseUrl = rtrim((string) config('services.przelewy24.url'), '/');

        return $baseUrl . $path;
    }
}
