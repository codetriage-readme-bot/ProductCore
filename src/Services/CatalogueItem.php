<?php

namespace RuffleLabs\ProductCore\Services;

use RuffleLabs\ProductCore\Models\Product;

class CatalogueItem
{
    protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function products()
    {
        return $this->products;
    }
}
