<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class QueuesSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
        for ($i=1; $i < 5; $i++) { 
            $queue = [
                'descripcion' => $faker->text($maxNbChars = 100),
                'turno' => 1,
                'id_categoria' => $i,
                'status' =>  '1',
                'reg_del' => '0',
                'user_mod' => 'SEED'
            ];
            DB::table('queues')->insert($queue);	
        }

    }
}
