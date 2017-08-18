<?php

function createAProduct($attributes = [], $amount = 1){
    factory('RuffleLabs\ProductCore\Models\Product', $amount)->create($attributes);
    return \RuffleLabs\ProductCore\Facades\Catalogue::products()->first();
}
