<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        // @todo is this necessary anymore? Feels like no?
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'App\Services\Registrar'
        );
    }
}
