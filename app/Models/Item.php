<?php

namespace App\Models;

use App\Traits\OrgAware;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use OrgAware;

    protected $guarded;
}
