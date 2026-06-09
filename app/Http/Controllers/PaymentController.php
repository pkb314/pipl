<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use App\Services\Przelewy24Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function start(Request $request, Przelewy24Service $przelewy24)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'email' => ['required', 'email'],
            'description' => ['nullable', 'string', 'max:255'],
            'client' => ['nullable', 'string', 'max:120'],
            'terms_accepted' => ['accepted'],
            'privacy_accepted' => ['accepted'],
        ]);

        $amount = (int) round(((float) $validated['amount']) * 100);
        $sessionId = 'PIPL-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(8));
        $currency = $przelewy24->currency();
        $description = $validated['description'] ?? 'Płatność PIPL';

        PaymentTransaction::create([
            'session_id' => $sessionId,
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'email' => $validated['email'],
            'client' => $validated['client'] ?? null,
            'status' => 'pending',
        ]);

        $payload = [
            'merchantId' => $przelewy24->merchantId(),
            'posId' => $przelewy24->posId(),
            'sessionId' => $sessionId,
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'email' => $validated['email'],
            'country' => 'PL',
            'language' => 'pl',
            'urlReturn' => route('payments.przelewy24.return', ['sessionId' => $sessionId]),
            'urlStatus' => route('payments.przelewy24.status'),
            'sign' => $przelewy24->sign([
                'sessionId' => $sessionId,
                'merchantId' => $przelewy24->merchantId(),
                'amount' => $amount,
                'currency' => $currency,
                'crc' => $przelewy24->crc(),
            ]),
        ];

        $response = $przelewy24->registerTransaction($payload);
        $token = $response['data']['token'] ?? $response['token'] ?? null;

        abort_unless($token, 502, 'Przelewy24 did not return a transaction token.');

        PaymentTransaction::where('session_id', $sessionId)->update([
            'token' => $token,
            'request_payload' => $payload,
            'response_payload' => $response,
        ]);

        return redirect()->away($przelewy24->transactionUrl($token));
    }

    public function return(Request $request)
    {
        return view('payments.return', [
            'sessionId' => $request->query('sessionId'),
        ]);
    }

    public function status(Request $request, Przelewy24Service $przelewy24)
    {
        $payload = $request->validate([
            'merchantId' => ['required', 'integer'],
            'posId' => ['required', 'integer'],
            'sessionId' => ['required', 'string'],
            'amount' => ['required', 'integer'],
            'originAmount' => ['required', 'integer'],
            'currency' => ['required', 'string', 'size:3'],
            'orderId' => ['required', 'integer'],
            'methodId' => ['required', 'integer'],
            'statement' => ['required', 'string'],
            'sign' => ['required', 'string'],
        ]);
        $sessionId = $payload['sessionId'] ?? null;

        $expectedSign = $przelewy24->notificationSign($payload);
        abort_unless(hash_equals($expectedSign, (string) $payload['sign']), 403, 'Invalid sign.');

        $transaction = PaymentTransaction::where('session_id', $sessionId)->firstOrFail();
        $amount = (int) ($payload['amount'] ?? $transaction->amount);
        $currency = $payload['currency'] ?? $transaction->currency;
        $orderId = (int) ($payload['orderId'] ?? 0);

        $verificationPayload = [
            'merchantId' => $przelewy24->merchantId(),
            'posId' => $przelewy24->posId(),
            'sessionId' => $sessionId,
            'amount' => $amount,
            'currency' => $currency,
            'orderId' => $orderId,
            'sign' => $przelewy24->sign([
                'sessionId' => $sessionId,
                'orderId' => $orderId,
                'amount' => $amount,
                'currency' => $currency,
                'crc' => $przelewy24->crc(),
            ]),
        ];

        $response = $przelewy24->verifyTransaction($verificationPayload);

        $transaction->update([
            'order_id' => $orderId ?: null,
            'amount' => $amount,
            'currency' => $currency,
            'status' => 'paid',
            'status_payload' => $payload,
            'verification_payload' => $response,
            'paid_at' => now(),
        ]);

        return response('OK');
    }
}
