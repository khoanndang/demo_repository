<?php

namespace App\Providers;

use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepositoryVersion1;
use App\Repositories\Product\ProductRepositoryVersion2;
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
        $this->app->singleton(
            ProductInterface::class,
            ProductRepositoryVersion2::class
        );
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
