<?php

namespace RealRipley\Buildable;

use Illuminate\Support\ServiceProvider;

class SimplePageBuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__.'/../migrations') => database_path('migrations') 
        ], 'migrations');
    }

    public function register()
    {

    }
}