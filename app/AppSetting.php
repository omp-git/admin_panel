<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Spatial;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppSetting extends Model
{
    use Spatial;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $spatial = ['location'];
}

