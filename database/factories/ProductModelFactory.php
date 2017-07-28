<?php

/** Product Core */
$factory->define(RuffleLabs\ProductCore\Models\Product::class, function(Faker\Generator $faker)
{

    return [
        'title' => ucfirst($faker->word),
        'description' => $faker->text,
        'seo_title' => $faker->word,
        'seo_description' => $faker->text,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
$factory->state(RuffleLabs\ProductCore\Models\Product::class, 'randomly_publish', function($faker)
{
    $published_at = rand(0, 9) < 8 ? $faker->dateTime() : NULL;

    return [
        'published_at' => $published_at,
    ];
});
