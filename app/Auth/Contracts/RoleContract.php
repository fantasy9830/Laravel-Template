<?php

namespace App\Auth\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface RoleContract
{
    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(): BelongsToMany;

    /**
     * Find a role by its name and guard name.
     *
     * @param string $name
     * @param string|null $guardName
     *
     * @return RoleContract
     */
    public static function findByName(string $name, $guardName): RoleContract;
}
