<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\NotificationServicesCaller', config('app.NOTIFICATION_PROVIDER'));
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
