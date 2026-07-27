<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isGlownyHandlowiec(): bool
    {
        return $this->role === 'glowny_handlowiec';
    }

    public function isHandlowiec(): bool
    {
        return in_array($this->role, ['handlowiec', 'glowny_handlowiec']);
    }

    public function canAssignLeads(): bool
    {
        return $this->isAdmin() || $this->isGlownyHandlowiec();
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
