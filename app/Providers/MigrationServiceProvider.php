<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register() : void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot() : void
    {
        $this->loadMigrationsFrom('Modules/Products/Database/migrations');
    }
}