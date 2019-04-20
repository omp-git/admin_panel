<?php

namespace App;

use Spatie\Permission\Models\Permission as spatiePermission;

class Permission extends spatiePermission
{
    // custom permission table
    protected $table = 'app_permissions';
}
