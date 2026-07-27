<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'company',
        'adres',
        'gmina',
        'powiat',
        'wojewodztwo',
        'email',
        'phone',
        'status',
        'bitrix_contact_id',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
        ];
    }

    public function isAccepted(): bool
    {
        return $this->status === 'zaakceptowane';
    }
}
