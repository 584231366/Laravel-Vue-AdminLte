<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\RoutesService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('RoutesService',function($app){
            return new RoutesService($app->router);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
