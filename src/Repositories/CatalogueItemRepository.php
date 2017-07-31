<?php

namespace RuffleLabs\ProductCore\Repositories;

use RuffleLabs\ProductCore\Models\Product;
use RuffleLabs\ProductCore\Repositories\Contracts\CatalogueItemInterface;
use RuffleLabs\ProductCore\Traits\PublishedTrait;
use RuffleLabs\ProductCore\Traits\VariantsTrait;

class CatalogueItemRepository extends RepositoryBase
{
    use PublishedTrait;
    use VariantsTrait;

    public function __construct(Product $item)
    {
        $this->item = $item;
        $this->item->setup();
    }
}
