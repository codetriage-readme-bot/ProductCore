<?php

namespace RuffleLabs\ProductCore\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use RuffleLabs\ProductCore\Models\ProductCost;

class CatalogueServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('catalogue', 'RuffleLabs\ProductCore\Services\CatalogueItem');
    }
}
