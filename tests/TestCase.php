<?php

namespace RuffleLabs\ProductCore\Tests;

use Guzzle\Service\Command\Factory\CompositeFactory;
use RuffleLabs\ProductCore\Providers\CoreServiceProvider;
use RuffleLabs\ProductCore\Facades\Catalogue;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Catalogue' => Catalogue::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate:refresh');

//        $pathToFactories = realpath(dirname(__DIR__).'/database/factories');

        $this->withFactories(realpath(dirname(__DIR__).'/database/factories'));
//        $this->factory = CompositeFactory::construct(\Faker\Factory::create(), $pathToFactories);

    }
}
