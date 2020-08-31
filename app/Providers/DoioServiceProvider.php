<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DoioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Requests\RequestInterface',
            'App\Http\Request\SolicitudRequest'       
        );
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
