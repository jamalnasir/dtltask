<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Products\App\Interfaces\ProductRepositoryInterface;
use Modules\Products\App\Repositories\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register() : void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot() : void
    {
        //
    }
}