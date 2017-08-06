<?php

namespace RuffleLabs\ProductCore\Services;

use RuffleLabs\ProductCore\Models\Product;

class CatalogueItem
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function testing()
    {
        return 'success';
    }
}
