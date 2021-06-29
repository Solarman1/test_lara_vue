<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OrderRegisterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Services\Interfaces\OrderRegisterServiceInterface','App\Services\OrderRegisterService');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
