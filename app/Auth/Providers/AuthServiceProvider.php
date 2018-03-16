<?php

namespace App\Auth\Providers;

use App\Auth\Libraries\ApiAuth;
use App\Auth\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('apiauth', function () {
            return new ApiAuth($this->app['request'], new UserRepository($this->app));
        });
    }
}
