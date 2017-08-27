<?php

/** Product Costs */
$factory->define(RuffleLabs\ProductCore\Models\ProductCost::class, function(Faker\Generator $faker) {

    return [
        'price'      => rand(0, 100000)/100,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
