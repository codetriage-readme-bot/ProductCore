<?php

namespace RuffleLabs\ProductCore\Facades;

use Illuminate\Support\Facades\Facade;

class Catalogue extends Facade
{
    protected static function getFacadeAccessor() { return 'catalogue'; }
}
