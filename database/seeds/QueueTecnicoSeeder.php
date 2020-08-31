<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class QueueTecnicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=1; $i < 5; $i++) { 
            $queueTecnico = [                                
                'turno' => 1,
                'estado_tecnico_cola' => '1',
                'id_cola' => $i,
                'id_tecnico' => $i,
                'status' =>  '1',
                'reg_del' => '0',
                'user_mod' => 'SEED'
            ];
            DB::table('queue_tecnicos')->insert($queueTecnico);	
        }
    }
}
