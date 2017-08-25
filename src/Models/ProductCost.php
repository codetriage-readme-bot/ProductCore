<?php

namespace RuffleLabs\ProductCore\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCost extends Model
{
    protected $table = 'product_costs';

    public $currency = '£';

    protected $fillable = [
        'product_id',
        'price'
    ];
}
