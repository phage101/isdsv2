<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DataTablesService;

class DataTablesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('datatables', function ($app) {
            return new DataTablesService();
        });
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
