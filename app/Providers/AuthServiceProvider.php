<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('CREATE_MARKERS', function(User $user) {
            return $user->canDo('CREATE_MARKERS', false);
        });

        Gate::define('UPDATE_MARKER', function(User $user) {
            return $user->canDo('UPDATE_MARKER', false);
        });

        Gate::define('DELETE_MARKER', function(User $user) {
            return $user->canDo('DELETE_MARKER', false);
        });

        Gate::define('CHANGE_ALL_MARKERS', function(User $user) {
            return $user->canDo('CHANGE_ALL_MARKERS', false);
        });

        Gate::define('VIEW_PERSONAL_MARKERS', function(User $user) {
            return $user->canDo('VIEW_PERSONAL_MARKERS', false);
        });

    }
}
