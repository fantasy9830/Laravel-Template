<?php

namespace App\Auth\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface PermissionContract
{
    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany;

    /**
     * Find a permission by its name and guard name.
     *
     * @param string $name
     * @param string|null $guardName
     *
     * @return PermissionContract
     */
    public static function findByName(string $name, $guardName): PermissionContract;
}
