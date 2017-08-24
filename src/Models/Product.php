<?php

namespace RuffleLabs\ProductCore\Models;

use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\SoftDeletes;
use RuffleLabs\ProductCore\Traits\PublishedTrait;

class Product extends Model
{
    use PublishedTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'products';

    protected $guarded = [];

    public function costs(){
        return $this->hasOne('RuffleLabs\ProductCore\Models\ProductCost');
    }
    
    public function getPriceAttribute(){
        return $this->costs->currency . $this->costs->price;
    }

    public function getPriceRawAttribute(){
        return $this->costs->price;
    }

    public function setPriceAttribute($price){
        $this->costs->price = $price;
        $this->costs->save();
    }
}
