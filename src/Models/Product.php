<?php

namespace RuffleLabs\ProductCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use RuffleLabs\ProductCore\Traits\ImageConversions;
use RuffleLabs\ProductCore\Traits\PublishedTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Product extends Model implements HasMediaConversions
{
    use HasMediaTrait;
    use PublishedTrait;
    use SoftDeletes;
    use ImageConversions;

    protected $dates = ['deleted_at'];

    protected $table = 'products';

    protected $fillable = ['title', 'description'];

    protected $with = ['categories'];

    private $categoryService;

    public function costs()
    {
        return $this->hasOne('RuffleLabs\ProductCore\Models\ProductCost');
    }

    public function variantGroups()
    {
        return $this->hasMany('RuffleLabs\ProductCore\Models\ProductVariantGroups');
    }

    public function categories()
    {
        return $this->morphToMany('RuffleLabs\ProductCore\Models\ProductCategory',
            'product',
            'product_categories_xref',
            'product_id',
            'category_id')
            ->where('parent_id', '=', NULL);
    }

    public function subcategories()
    {
        return $this->morphToMany('RuffleLabs\ProductCore\Models\ProductCategory',
            'product',
            'product_categories_xref',
            'product_id',
            'category_id')
            ->whereNotNull('parent_id');
    }

    public function images()
    {
        return $this->getMedia('product-images');
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

    public function removeAllCategories()
    {
        DB::table('product_categories_xref')
            ->where('product_id', $this->id)
            ->delete();
    }

    public function assignCategories(array $categories = [])
    {
        foreach($categories as $categoryId) {
            $category = ProductCategory::find($categoryId);
            $this->assignCategory($category);
        }
    }

    public function assignCategory(ProductCategory $category)
    {
        if(is_null($category->parent_id)){
            return $this->assignSubCategory($category);
        }
        return $this->categories()->save($category);
    }

    public function assignSubCategory(ProductCategory $category)
    {
        $this->subcategories()->save($category);
    }


}
