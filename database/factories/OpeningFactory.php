<?php

/** @var Factory $factory */

use App\Establishment;
use App\Opening;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Opening::class, function (Faker $faker) {
    $hours = Carbon::createFromTimeString($faker->time(), 'Europe/London');
    return [
        'weekday' => $faker->dayOfWeek,
        'start' => date('H:i', strtotime($hours)),
        'end' => date('H:i', strtotime($hours->addHours(8))),
        'active' => $faker->boolean(100),
        'establishment_id' => Establishment::all()->random()->id,
    ];
});
