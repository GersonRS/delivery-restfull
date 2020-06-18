<?php

/** @var Factory $factory */

use App\Item;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'value' => $faker->randomFloat(2, 10, 50),
        'active' => $faker->boolean(50),
        'order' => $faker->randomDigit
    ];
});
