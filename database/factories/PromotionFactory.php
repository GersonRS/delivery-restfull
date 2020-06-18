<?php

/** @var Factory $factory */

use App\Promotion;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Promotion::class, function (Faker $faker) {
    return [
        'value' => $faker->randomFloat(2, 10, 50),
        'active' => $faker->boolean(50),
    ];
});
