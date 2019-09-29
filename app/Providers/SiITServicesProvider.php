<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SiITServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\SiITServicesCaller', config('app.SiIT_PROVIDER'));

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
