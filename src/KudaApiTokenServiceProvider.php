<?php

namespace Giftbalogun\Kudaapitoken;

use Illuminate\Support\ServiceProvider;

class KudaApiTokenServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var  bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Migration
        $this->loadMigrationsFrom(__DIR__.'/migrations');

    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Kudaapitoken', function()
        {
            return new KudaApiToken;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Kudaapitoken'];
    }

}
