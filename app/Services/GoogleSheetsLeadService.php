<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class GoogleSheetsLeadService
{
    public function appendLead(array $leadData): void
    {
        $webhookUrl = config('services.google_sheets.webhook_url');

        if (!$webhookUrl) {
            throw new RuntimeException('Google Sheets webhook URL is not configured.');
        }

        $response = Http::timeout(10)
            ->acceptJson()
            ->withOptions(['allow_redirects' => true])
            ->post($webhookUrl, [
                'submitted_at' => now()->timezone(config('app.timezone'))->format('Y-m-d H:i:s'),
                'name' => $leadData['name'],
                'surname' => $leadData['surname'],
                'company' => $leadData['company'],
                'email' => $leadData['email'],
                'phone' => $leadData['phone'],
            ]);

        if ($response->failed() || $response->json('ok') !== true) {
            throw new RuntimeException('Google Sheets webhook request failed: ' . $response->body());
        }
    }
}
