<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Felipe Emanoel',
            'email' => 'felipe.vidal.mesquita@gmail.com',
            'nivel' => 'Super-Admin',
            'password' => bcrypt('pmm12345'),
        ]);
    }
}
