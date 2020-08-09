<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'nombre' => $faker->text($maxNbChars = 10),
        'descripcion' => $faker->text($maxNbChars = 100),
        'prioridad' => $faker->numberBetween(1,5),
        'is_public' => $faker->numberBetween(0,1)
    ];
});
