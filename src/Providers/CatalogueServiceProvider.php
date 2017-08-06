<?php

namespace RuffleLabs\ProductCore\Providers;

use Illuminate\Support\ServiceProvider;

class CatalogueServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('catalogue', 'RuffleLabs\ProductCore\Services\CatalogueItem');
    }
}
