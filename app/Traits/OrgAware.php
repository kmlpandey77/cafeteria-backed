<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait OrgAware
{
    protected static function bootOrgAware(): void
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->org_id = auth()->user()->org_id;
            }
        });

        static::addGlobalScope('org', function (Builder $builder) {
            if (auth()->check()) {
                $builder->where('org_id', auth()->user()->org_id);
            }
        });
    }
}