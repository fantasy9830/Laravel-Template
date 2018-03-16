<?php

namespace App\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'auth_role_user';
}
