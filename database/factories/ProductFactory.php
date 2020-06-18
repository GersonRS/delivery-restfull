<?php

/** @var Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat(2, 10, 50),
        'image' =>$faker->imageUrl(640,480,'food',true,'Faker'),
        'category_id' => Category::all()->random()->id,
        'active' => $faker->boolean(100),
        'order' => $faker->randomDigit
    ];
});
