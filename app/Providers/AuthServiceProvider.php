<?php

namespace App\Providers;

use App\Actions\Auth\JWTAction;
use App\Contracts\AuthContract;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        $this->app->singleton(AuthContract::class, function (Application $app) {
            return new JWTAction();
        });
    }
}
