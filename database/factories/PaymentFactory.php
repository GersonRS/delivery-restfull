<?php

/** @var Factory $factory */

use App\Payment;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'icon' => $faker->image()
    ];
});
