<?php

namespace RuffleLabs\ProductCore\Providers;

use \Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

use RuffleLabs\ProductCore\Console\Commands\ProductCoreMigrationCommand;
use RuffleLabs\ProductCore\Models\Product;
use RuffleLabs\ProductCore\Models\ProductCost;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config' => config_path()]);

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        Product::created(function($product) {
            $productCost = new ProductCost([
                'product_id' => $product->id,
                'price' => '0.00'
            ]);
            $productCost->save();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/catalogue.php', 'catalogue');

        $this->commands([
            ProductCoreMigrationCommand::class,
        ]);
    }
}
