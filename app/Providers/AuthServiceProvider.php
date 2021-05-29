<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Page;

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
        $this->registerPagePolicies();
        //
    }

    public function registerPagePolicies() {

        Gate::define('create-page', function($user) {
            return $user->hasAccess(['create-page']);
        });
        Gate::define('update-page', function($user,Page $page) {
            return $user->hasAccess(['update-page']) || $user->id == $page->user_id;
        });
        Gate::define('view-page', function($user) {
            return $user->hasAccess(['view-page']);
        });
        Gate::define('delete-page', function($user) {
            return $user->hasAccess(['delete-page']);
        });
    }
}
