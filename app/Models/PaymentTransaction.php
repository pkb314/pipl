<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [
        'session_id',
        'order_id',
        'token',
        'amount',
        'currency',
        'description',
        'email',
        'client',
        'status',
        'request_payload',
        'response_payload',
        'status_payload',
        'verification_payload',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'request_payload' => 'array',
            'response_payload' => 'array',
            'status_payload' => 'array',
            'verification_payload' => 'array',
            'paid_at' => 'datetime',
        ];
    }
}
