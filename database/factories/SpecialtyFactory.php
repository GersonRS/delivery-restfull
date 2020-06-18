<?php

/** @var Factory $factory */

use App\Specialty;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Specialty::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
