<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('canViewFiles', function ($user,$department) {
            return $user->isAdmin() || $user->department_id === $department->id;
        });

        Gate::define('canUploadFiles', function ($user) {
            return $user->isAdmin() || $user->can_upload_files;
        });

        Gate::define('canUpdateFiles', function ($user,$files) {
            return $user->isAdmin() || $user->id === $files->user_id;
        });

    }
}
