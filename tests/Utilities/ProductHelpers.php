<?php

function getAProduct($attributes = []){
    factory('RuffleLabs\ProductCore\Models\Product', 1)->create($attributes);
    return \RuffleLabs\ProductCore\Facades\Catalogue::products()->first();
}
