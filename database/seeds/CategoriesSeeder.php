<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
      $faker = Faker::create();
      $arrayCategories = [];
      $category1 = [
        'nombre' => 'CMS',
        'descripcion' => $faker->text($maxNbChars = 100),
        'prioridad' => $faker->numberBetween(1,5),
        'is_public' => $faker->numberBetween(0,1),
        'status' => 'activo',
        'reg_del' => '0',
        'user_mod' => 'seed',
      ];
      $category2 = [
        'nombre' => 'Security',
        'descripcion' => $faker->text($maxNbChars = 100),
        'prioridad' => $faker->numberBetween(1,5),
        'is_public' => $faker->numberBetween(0,1),
        'status' => 'activo',
        'reg_del' => '0',
        'user_mod' => 'seed',
      ];
      $category3 = [
        'nombre' => 'ACTIF',
        'descripcion' => $faker->text($maxNbChars = 100),
        'prioridad' => $faker->numberBetween(1,5),
        'is_public' => $faker->numberBetween(0,1),
        'status' => 'activo',
        'reg_del' => '0',
        'user_mod' => 'seed',
      ];
      $category4 = [
        'nombre' => 'GESDOC',
        'descripcion' => $faker->text($maxNbChars = 100),
        'prioridad' => $faker->numberBetween(1,5),
        'is_public' => $faker->numberBetween(0,1),
        'status' => 'activo',
        'reg_del' => '0',
        'user_mod' => 'seed',
      ];
      
      array_push($arrayCategories, $category1);
      array_push($arrayCategories, $category2);
      array_push($arrayCategories, $category3);
      array_push($arrayCategories, $category4);

      DB::table('categorias')->insert($arrayCategories);		
    }
}
