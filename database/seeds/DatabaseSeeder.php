<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                 
        //$this->call(GuardaTableSeeder::class);
        $this->call(CargoTableSeeder::class);
        //$this->call(TipoEscalasTableSeeder::class);
        //$this->call(SetorTableSeeder::class);

    }
}
