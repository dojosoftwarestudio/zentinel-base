<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rol;
use Faker\Generator as Faker;

$factory->define(Rol::class, function (Faker $faker) {
    return [
        'name' => $faker->text($maxNbChars = 10),
        'status' => 'activo',
        'reg_del' => '0',
        'user_mod' => 'seed',
    ];
});
