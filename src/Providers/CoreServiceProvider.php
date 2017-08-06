<?php

namespace RuffleLabs\ProductCore\Providers;

use Illuminate\Support\ServiceProvider;

use RuffleLabs\ProductCore\Console\Commands\ProductCoreMigrationCommand;

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
    }

    /**
     * Register the application services.
     *
     * @return voidx
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/catalogue.php', 'catalogue');

        $this->commands([
            ProductCoreMigrationCommand::class,
        ]);
    }
}
