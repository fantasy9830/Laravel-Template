<?php

namespace App\Auth\Models;

use App\Auth\Contracts\PermissionContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model implements PermissionContract
{
    protected $connection = 'pgsql';

    protected $table = 'auth_permissions';

    /**
     * A permission can be applied to roles.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'auth_permission_role');
    }

    /**
     * Find a permission by its name and guard name.
     *
     * @param string $name
     * @param string|null $guardName
     *
     * @return PermissionContract
     */
    public static function findByName(string $name, $guardName = null): PermissionContract
    {
        $guardName = $guardName ?? 'auth';

        $permission = static::where('name', $name)->where('guard_name', $guardName)->first();

        if (!$permission) {
            throw new static("There is no permission named `{$name}` for system `{$guardName}`.");
        }

        return $permission;
    }
}
