<?php

/** @var Factory $factory */

use App\Availability;
use Faker\Generator as Faker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Availability::class, function (Faker $faker) {
    $hours = Carbon::createFromTimeString($faker->time(), 'Europe/London');
    return [
        'weekday' => $faker->dayOfWeek,
        'start' => date('H:i', strtotime($hours)),
        'end' => date('H:i', strtotime($hours->addHours(8))),
        'active' => $faker->boolean(100)
    ];
});
