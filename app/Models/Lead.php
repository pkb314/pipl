<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    protected $fillable = [
        'user_id',
        'assigned_to',
        'name',
        'surname',
        'company',
        'adres',
        'gmina',
        'gmina_reason',
        'powiat',
        'wojewodztwo',
        'email',
        'phone',
        'business_sector',
        'nip',
        'knows_entrepreneurs',
        'own_business',
        'meeting_new_people',
        'organized_events',
        'handling_refusal',
        'local_government_contacts',
        'working_style',
        'weekly_time',
        'motivation',
        'confidentiality',
        'conflicts',
        'why_you',
        'additional_info',
        'about',
        'status',
        'source',
        'stage',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(LeadComment::class)->orderBy('created_at');
    }
}
