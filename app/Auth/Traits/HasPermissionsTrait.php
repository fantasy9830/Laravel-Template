<?php

namespace App\Auth\Traits;

use Illuminate\Support\Collection;

trait HasPermissionsTrait
{
    /**
     * Return all the permissions the model has via roles.
     */
    public function getPermissions(): Collection
    {
        return $this->load('roles', 'roles.permissions')
            ->roles->flatMap(function ($role) {
                return $role->permissions;
            })->sort()->values();
    }
}
