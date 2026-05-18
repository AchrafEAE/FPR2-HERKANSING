<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Enums\UserRole;

final class BioPolicy
{
    /**
     * Determine if user can view the bio
     */
    public function view(?User $user): bool
    {
        // Anyone can view (public)
        return true;
    }

    /**
     * Determine if user can update the bio (owner or editor only)
     */
    public function update(User $user): bool
    {
        return $user->hasAnyRole([UserRole::Owner, UserRole::Editor]);
    }

    /**
     * Determine if user can delete the bio (owner only)
     */
    public function delete(User $user): bool
    {
        return $user->hasRole(UserRole::Owner);
    }
}
