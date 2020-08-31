<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Solicitud;
use Faker\Generator as Faker;

$factory->define(Solicitud::class, function (Faker $faker) {
    return [
        
        'codigo' => $faker->text($maxNbChars = 10),
        'descripcion' => $faker->text($maxNbChars = 100),
        'id_user' => $faker->numberBetween(1,5),
        'id_tecnico' => $faker->numberBetween(1,3),
        'id_categoria' => $faker->numberBetween(1,4),
        'estado' => $faker->numberBetween(1,5),
        'status' => 'activo',
        'reg_del' => '0',
        'user_mod' => 'seed',
    ];
});
