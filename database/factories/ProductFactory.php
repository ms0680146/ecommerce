<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'slug' => $faker->slug,
        'feature' => false,
        'detail' => $faker->sentence(8),
        'price' => $faker->numberBetween(10000, 50000),
        'description' => $faker->paragraph,
    ];
});
