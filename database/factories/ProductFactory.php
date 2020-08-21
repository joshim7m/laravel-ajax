<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        
        'name' => $faker->sentence(4),
        'price'=> $faker->numberBetween($min = 500, $max = 1000),
    ];
});
