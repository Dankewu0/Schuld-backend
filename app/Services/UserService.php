<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function getPaginatedUsers(int $perPage = 10): LengthAwarePaginator
    {
        return User::query()
            ->latest()
            ->paginate($perPage);
    }

    public function createUser(array $data): User
    {
        return User::create($data);
    }

    public function updateUser(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }

    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }
}
