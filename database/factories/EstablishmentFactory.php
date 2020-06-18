<?php

/** @var Factory $factory */

use App\Establishment;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Establishment::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->sentence,
//        'type' => $faker->randomElement(['restaurant', 'marketplace', 'drugstore']),
        'type' => 'restaurant',
        'address' => $faker->address,
        'number' => $faker->randomDigit,
        'phone' => $faker->phoneNumber,
        'image' =>$faker->imageUrl(640,480,'business',true,'Faker'),
        'thumbnail' =>$faker->imageUrl(200,200,'business',true,'Faker'),
        'delivery_fee' =>$faker->randomFloat(2, 4, 8),
        'minimum_value' =>$faker->randomFloat(2, 10, 20),
        'active' => $faker->boolean(100),
        'delivery_time_min' => $faker->numberBetween(30,50),
        'delivery_time_max' => $faker->numberBetween(55,90)
    ];
});
