<?php

/** Product Core */
$factory->define(RuffleLabs\ProductCore\Models\ProductCategory::class, function(Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->word),
        'slug' => $faker->slug,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
