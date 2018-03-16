<?php

namespace App\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Auth\Traits\HasPermissionsTrait;

class User extends Model
{
    use HasPermissionsTrait;

    protected $connection = 'pgsql';

    protected $table = 'user';

    public $timestamps = false;

    /**
     * A user may have multiple roles.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'auth_role_user', 'user_id', 'role_id');
    }
}
