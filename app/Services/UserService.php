<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;

final class UserService
{
    /**
     * Register a new user
     */
    public function register(string $email, string $password, UserRole $role = UserRole::Visitor): User
    {
        $name = (string) strstr($email, '@', true) ?: 'User';

        return User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
        ]);
    }

    /**
     * Authenticate a user
     */
    public function authenticate(string $email, string $password): ?User
    {
        $user = User::query()->where('email', $email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }

    /**
     * Update user role
     */
    public function updateRole(User $user, UserRole $role): User
    {
        $user->update(['role' => $role]);

        return $user;
    }

    /**
     * Promote user to editor
     */
    public function promoteToEditor(User $user): User
    {
        return $this->updateRole($user, UserRole::Editor);
    }

    /**
     * Demote user to visitor
     */
    public function demoteToVisitor(User $user): User
    {
        return $this->updateRole($user, UserRole::Visitor);
    }
}
