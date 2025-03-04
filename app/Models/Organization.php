<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Organization extends Model
{
    protected $guarded;

    protected static function boot(): void
    {
        static::creating(function ($organization) {
            $organization->license_key = Str::uuid();
        });

        parent::boot();
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'agent_id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(RenewLog::class , 'org_id');

    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class , 'org_id');

    }
}
