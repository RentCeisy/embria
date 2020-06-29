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
        $this->app->bind('App\Repositories\Impl\NewsRepositoryImpl',
            'App\Repositories\NewsRepository');
        $this->app->bind('App\Services\Impl\NewsServiceImpl',
            'App\Services\NewsService');
        $this->app->bind('App\Repositories\Impl\PhotoRepositoryImpl',
            'App\Repositories\PhotoRepository');
        $this->app->bind('App\Services\Impl\PhotoServiceImpl',
            'App\Services\PhotoService');
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
