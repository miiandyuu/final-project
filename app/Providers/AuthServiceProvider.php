<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is_staff_or_admin', function(User $user) {
            return $user->role == 'staff' || $user->role == 'admin';
        });

        Gate::define('is_staff', function(User $user) {
            return $user->role == 'staff';
        });

        Gate::define('is_admin', function(User $user) {
            return $user->role == 'admin';
        });
    }
}
