<?php

function createAProduct($attributes = [], $amount = 1){
    factory('RuffleLabs\ProductCore\Models\Product', $amount)->create($attributes);
    return Catalogue::products()->first();
}

function createACategory($attributes = [], $amount = 1){
    $cat = factory('RuffleLabs\ProductCore\Models\ProductCategory', $amount)->create($attributes);
    return $cat->first();
}

function createASubCategory($parentId = 1, $attributes = [], $amount = 1){
    $attributes = $attributes + ['parent_id' => $parentId];
    $cat = factory('RuffleLabs\ProductCore\Models\ProductCategory', $amount)->create($attributes);
    return $cat->first();
}
