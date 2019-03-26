<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;
use TCG\Voyager\Traits\Translatable;

class Test extends Model
{
    use Resizable;
    use Spatial;
    use Translatable;

    protected $spatial = ['location'];
    protected $translatable = ['body'];

}
