<?php

namespace App;

use Spatie\Permission\Models\Role as spatieRole;

class Role extends spatieRole
{
//  custom role table
    protected $table = 'app_roles';
}
