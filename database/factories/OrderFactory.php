<?php

/** @var Factory $factory */

use App\Address;
use App\Establishment;
use App\Order;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'address_id' => Address::all()->random()->id,
        'establishment_id' => Establishment::all()->random()->id,
        'total' => $faker->randomFloat(2, 50, 250),
        'pay' => $faker->randomFloat(2, 50, 250),
        'status' => $faker->randomElement(['waiting','accept', 'doing', 'delivering'])
    ];
});
