<?php

namespace App\Auth\Models;

use App\Auth\Contracts\RoleContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model implements RoleContract
{
    protected $connection = 'pgsql';

    protected $table = 'auth_roles';

    /**
     * A role may be given various permissions.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'auth_permission_role');
    }

    /**
     * Find a role by its name and guard name.
     *
     * @param string $name
     * @param string|null $guardName
     *
     * @return RoleContract
     */
    public static function findByName(string $name, $guardName = null): RoleContract
    {
        $guardName = $guardName ?? 'auth';

        $role = static::where('name', $name)->where('guard_name', $guardName)->first();

        if (!$role) {
            throw new static("There is no role named `{$name}`.");
        }

        return $role;
    }
}
