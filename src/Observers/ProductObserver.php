<?php

namespace RuffleLabs\ProductCore\Observers;

use RuffleLabs\ProductCore\Models\Product;
use RuffleLabs\ProductCore\Models\ProductCost;

class ProductObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  Product $Product
     * @return void
     */
    public function created(Product $product)
    {
        $price = new ProductCost(['price' => '0.00']);
        Product::find($product->id)->costs()->save($price);
    }
}
