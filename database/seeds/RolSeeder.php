<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     
            $rol = [                                
                'name' => 'Administrador',                
                'status' =>  '1',
                'reg_del' => '0',
                'user_mod' => 'SEED'
            ];
            DB::table('rols')->insert($rol);	
            $rol = [                                
                'name' => 'Tecnico',                
                'status' =>  '1',
                'reg_del' => '0',
                'user_mod' => 'SEED'
            ];
            DB::table('rols')->insert($rol);	
            $rol = [                                
                'name' => 'Solicitante',                
                'status' =>  '1',
                'reg_del' => '0',
                'user_mod' => 'SEED'
            ];
            DB::table('rols')->insert($rol);	

    }
}
