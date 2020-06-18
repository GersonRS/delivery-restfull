<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'number' => $faker->randomDigit,
        'neighborhood' => $faker->state,
        'city' => $faker->city,
        'active' => $faker->boolean(100)
    ];
});
