<?php

namespace App\Models;

use App\Traits\OrgAware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use OrgAware;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->order_by = $model::where('category_id', $model->category_id)->max('order_by') + 1;
        });
    }

    protected $guarded;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault([
            'title' => 'None'
        ]);
    }
}
