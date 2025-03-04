<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait OrderByTrait
{
    protected static function bootOrderByTrait(): void
    {
        static::creating(function ($model) {
            $model->order_by = $model::max('order_by') + 1;
        });
    }
}