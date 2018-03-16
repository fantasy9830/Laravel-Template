<?php

namespace App\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'auth_permission_role';
}
