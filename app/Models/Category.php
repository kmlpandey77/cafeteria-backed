<?php

namespace App\Models;

use App\Traits\OrgAware;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use OrgAware;
    protected $guarded = [];
}
