<?php

namespace RuffleLabs\ProductCore;

use Illuminate\Support\ServiceProvider;

class ProductCoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config' => config_path(),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/database/migrations/');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/product.php', 'product'
        );


    }
}
