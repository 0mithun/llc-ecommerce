<?php

use App\Models\Product;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id'       =>  Category::all()->random()->id,
        'title'             =>  $faker->unique()->name,
        'description'       =>  $faker->realText(),
        'price'             =>  random_int(100,1000),
    ];
});
