<?php

namespace RuffleLabs\ProductCore\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;

class ProductCoreMigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all migrations for the RuffleLabs\ProductCore package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Composer $composer)
    {
        $this->call('migrate', array('--path' => 'vendor/ruffle-labs/product-core/database/migrations'));
    }
}
