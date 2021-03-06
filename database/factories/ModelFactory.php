<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** Product Core */

$factory->define(RuffleLabs\ProductCore\Models\Product::class, function (Faker\Generator $faker) {

    return [
        'title' => ucfirst($faker->word),
        'description' => $faker->text,
        'seo_title' => $faker->word,
        'seo_description' => $faker->text,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
$factory->state(RuffleLabs\ProductCore\Models\Product::class, 'randomly_publish', function ($faker) {
    $published_at = rand(0, 9) < 8 ? $faker->dateTime() : NULL;
    return [
        'published_at' => $published_at,
    ];
});
