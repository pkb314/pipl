<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'przelewy24' => [
        'url' => env('PRZELEWY24_URL', 'https://sandbox.przelewy24.pl'),
        'merchant_id' => env('PRZELEWY24_MERCHANT_ID'),
        'pos_id' => env('PRZELEWY24_POS_ID', env('PRZELEWY24_MERCHANT_ID')),
        'api_key' => env('PRZELEWY24_API_KEY'),
        'crc' => env('PRZELEWY24_CRC'),
        'currency' => env('PRZELEWY24_CURRENCY', 'PLN'),
    ],

    'google_sheets' => [
        'webhook_url' => env('GOOGLE_SHEETS_WEBHOOK_URL'),
    ],

];
