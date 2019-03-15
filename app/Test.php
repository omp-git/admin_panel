<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;

class Test extends Model
{
    use Resizable;
    use Spatial;

    protected $spatial = ['location'];

}
