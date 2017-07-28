<?php

namespace RuffleLabs\ProductCore\Tests;

use RuffleLabs\ProductCore\Providers\CatalogueServiceProvider;
use RuffleLabs\ProductCore\Providers\CoreServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class,
            CatalogueServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Catalogue' => \RuffleLabs\ProductCore\Facades\Catalogue::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'host'   => '127.0.0.1',
            'driver'   => 'mysql',
            'database' => 'ruffle_testing',
            'username'   => env('DB_USERNAME', 'root'),
            'password'   => env('DB_PASSWORD', null),
        ]);
    }

    public function setUp()
    {
        parent::setUp();
        $this->withFactories(realpath(dirname(__DIR__).'/database/factories'));
    }
}
