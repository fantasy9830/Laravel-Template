<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DebugbarServiceProvider extends ServiceProvider
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
        if ($this->app->environment() == 'local' && env('APP_DEBUG') && env('DEBUGBAR')) {
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        }
    }
}
