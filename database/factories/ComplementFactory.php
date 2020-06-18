<?php

/** @var Factory $factory */

use App\Complement;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Complement::class, function (Faker $faker) {
    $number = $faker->randomDigit;
    return [
        'name' => $faker->name,
        'min' => $number,
        'max' => $number+2,
        'active' => $faker->boolean(50),
        'mandatory' => $faker->boolean(50),
        'order' => $faker->randomDigit
    ];
});
