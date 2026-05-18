<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Bio;
use App\Policies\BioPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Bio::class => BioPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define custom gates if needed
        Gate::define('manage-users', function ($user) {
            return $user->hasRole(\App\Enums\UserRole::Owner);
        });
    }
}
