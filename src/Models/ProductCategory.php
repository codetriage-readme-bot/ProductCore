<?php

namespace RuffleLabs\ProductCore\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected $fillable = ['product_id', 'category_id', 'product_type'];

    public function children()
    {
        return $this->whereParentId($this->id)->get();
    }

    public function parent()
    {
        return $this->whereId($this->parent_id)->first();
    }
}
