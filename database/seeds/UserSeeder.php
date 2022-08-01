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
      [
        'name' => 'Felipe Emanoel',
        'email' => 'felipe.vidal.mesquita@gmail.com',
        'nivel' => 'Super-Admin',
        'password' => bcrypt('pmm12345'),
      ],
      [
        'name' => 'Victor Mussel',
        'email' => 'victor.mussel@hotmail.com',
        'nivel' => 'Super-Admin',
        'password' => bcrypt('pmm12345'),
      ],
      [
        'name' => 'Daniela da Silva Monteiro de Almeida',
        'email' => 'danielamonteiro@mesquita.rj.gov.br',
        'nivel' => 'Super-Admin',
        'password' => bcrypt('pmm12345'),
      ],
      [
        'name' => 'Keren Gomes de Lima',
        'email' => 'pericia.medica@mesquita.rj.gov.br',
        'nivel' => 'Admin',
        'password' => bcrypt('pmm12345'),
      ],
      [
        'name' => 'Priscila de Melo Santos Teixeira',
        'email' => 'priscila.melo@mesquita.rj.gov.br',
        'nivel' => 'Admin',
        'password' => bcrypt('pmm12345'),
      ],
    ]);
  }
}