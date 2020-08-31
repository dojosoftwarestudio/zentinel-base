<?php

use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayEstados = [];
        $estado1 = [
            'descripcion' => 'Sin Asignar',
            'codigo' => 'SA',            
            'color' => 'gray',
            'status' => 'activo',
            'reg_del' => '0',
            'user_mod' => 'seed',
        ]; 
        $estado2 = [
            'descripcion' => 'En Proceso',
            'codigo' => 'EP',            
            'color' => 'blue',
            'status' => 'activo',
            'reg_del' => '0',
            'user_mod' => 'seed',
        ]; 
        $estado3 = [
            'descripcion' => 'Cronogramado',
            'codigo' => 'CR',            
            'color' => 'orange',
            'status' => 'activo',
            'reg_del' => '0',
            'user_mod' => 'seed',
        ]; 
        $estado4 = [
            'descripcion' => 'Rechazada',
            'codigo' => 'R',            
            'color' => 'red',
            'status' => 'activo',
            'reg_del' => '0',
            'user_mod' => 'seed',
        ]; 
        $estado5 = [
            'descripcion' => 'Finalizado',
            'codigo' => 'F',            
            'color' => 'green',
            'status' => 'activo',
            'reg_del' => '0',
            'user_mod' => 'seed',
        ]; 
        array_push($arrayEstados, $estado1);
        array_push($arrayEstados, $estado2);
        array_push($arrayEstados, $estado3);
        array_push($arrayEstados, $estado4);
        array_push($arrayEstados, $estado5);

        DB::table('estados')->insert($arrayEstados);
    }
}
