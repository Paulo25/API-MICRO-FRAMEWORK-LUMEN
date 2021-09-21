<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // pegar o serviço do jwt dentro da pasta vendor
        $this->app->register(\Tymon\JWTAuth\Providers\LumenServiceProvider::class);
    }
}
