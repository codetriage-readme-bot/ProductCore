<?php

namespace RuffleLabs\ProductCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RuffleLabs\ProductCore\Traits\PublishedTrait;

class Product extends Model
{
    use PublishedTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'products';

    protected $guarded = [];

    protected $with = ['categories'];

    private $categoryService;


    public function costs()
    {
        return $this->hasOne('RuffleLabs\ProductCore\Models\ProductCost');
    }

    public function categories()
    {
        return $this->morphToMany('RuffleLabs\ProductCore\Models\ProductCategory',
            'product',
            'product_categories_xref',
            'product_id',
            'category_id');
    }

    public function getPriceAttribute()
    {
        return $this->costs->currency . $this->costs->price;
    }

    public function getPriceRawAttribute()
    {
        return $this->costs->price;
    }

    public function setPriceAttribute($price)
    {
        $this->costs->price = $price;
        $this->costs->save();
    }

    public function hasCategory()
    {
        if($this->categories()->count() > 0){
            return true;
        }
        return false;
    }

    public function assignCategory(ProductCategory $category)
    {
        $this->categories()->save($category);
    }
}
