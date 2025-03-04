<?php

namespace App\Models;

use App\Traits\OrgAware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use OrgAware;
    protected $guarded = [];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault([
            'title' => 'None'
        ]);
    }
}
