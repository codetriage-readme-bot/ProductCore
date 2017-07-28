<?php

namespace RuffleLabs\ProductCore\Services;

use RuffleLabs\ProductCore\Models\Product;
use RuffleLabs\ProductCore\Models\ProductCategory;

class CatalogueItem
{
    protected $products;
    protected $categories;

    public function __construct(Product $products, ProductCategory $categories)
    {
        $this->products = $products;
        $this->categories = $categories;
    }

    public function products()
    {
        return $this->products;
    }

    public function categories()
    {
        return $this->categories->whereNull('parent_id');
    }

    public function subcategories()
    {
        return $this->categories->whereNotNull('parent_id');
    }
}
