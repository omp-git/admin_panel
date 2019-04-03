<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;
use TCG\Voyager\Traits\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;

class Test extends Model
{
    use Resizable;
    use Spatial;
    use Translatable;
    use Sluggable;

    protected $spatial = ['location'];
    protected $translatable = ['name', 'body'];
    public function sluggable()
    {
        return [
            'slug_en' => [
                'source' => 'name'
            ],
            'slug_fa' => [
                'source' => ''
            ],
        ];
    }

}
