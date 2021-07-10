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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

         /**
         * Define an admin user role
         * @param $user - the current logged in user
         */
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });

        /**
         * Define a user role
         * @param $user - the current logged in user
         */
        Gate::define('isUser', function($user) {
            return $user->role == 'user';
        });
    }
}
