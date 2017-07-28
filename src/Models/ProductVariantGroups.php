<?php

namespace RuffleLabs\ProductCore\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantGroups extends Model
{
//    protected $with = ['variants'];

    public function variants()
    {
        return $this->hasMany('RuffleLabs\ProductCore\Models\ProductVariants', 'variant_group_id', 'id');
    }
}
