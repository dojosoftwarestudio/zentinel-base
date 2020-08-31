<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'estados',
            'categorias',
            'users',
            'solicitudes',
            'queues',
            'queue_tecnicos',
            'rols',
        ]);

        $this->call(EstadosSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SolicitudesSeeder::class);
        $this->call(QueuesSeeder::class);
        $this->call(QueueTecnicoSeeder::class);
        $this->call(RolSeeder::class);
    }
    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); 
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        } 
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}

