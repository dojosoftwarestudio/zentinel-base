<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RolesBlue;
use Faker\Generator as Faker;

$factory->define(RolesBlue::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'category_id' => factory(\App\Models\Category::class),
        'slug' => $faker->slug,
    ];
});
