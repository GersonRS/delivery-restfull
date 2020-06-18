<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Artesaos\Defender\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => 'Admin'
    ];
});
