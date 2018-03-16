<?php

namespace App\Auth\Repositories;

use App\Auth\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * UserRepository
 */
class UserRepository extends BaseRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function hasUser(string $userId): bool
    {
        return $this->model->where('id', $userId)->count() > 0;
    }

    public function getPermissions(string $userId)
    {
        return $this->find($userId)->getPermissions()->pluck('name');
    }

    public function getRoles(string $userId)
    {
        return $this->find($userId)->roles()->pluck('name');
    }
}
