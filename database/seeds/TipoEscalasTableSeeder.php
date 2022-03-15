<?php

use Illuminate\Database\Seeder;

class TipoEscalasTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		DB::table('tipo_escalas')->insert(['nome' => '12 X 60 DIURNA', 		'inicio' => '07:00:00',
																			'termino' => '19:00:00', 
																			'duracao' => '12', 
																			'periodicidade' => '60', 
																			'intervalo' => '01:00:00', 
																			'ativa' => '1']);

		DB::table('tipo_escalas')->insert(['nome' => '12 X 60 NOTURNA', 	'inicio' => '19:00:00',
																			'termino' => '07:00:00', 
																			'duracao' => '12', 
																			'periodicidade' => '60', 
																			'intervalo' => '01:00:00', 
																			'ativa' => '1']);

		DB::table('tipo_escalas')->insert(['nome' => '12 X 36 SEG A SEX', 	'inicio' => '07:00:00',
																			'termino' => '17:00:00', 
																			'duracao' => '12', 
																			'periodicidade' => '36', 
																			'intervalo' => '01:00:00', 
																			'ativa' => '1']);

		DB::table('tipo_escalas')->insert(['nome' => 'EXPEDIENTE',			'inicio' => '09:00:00',
																			'termino' => '17:00:00', 
																			'duracao' => '9', 
																			'periodicidade' => '24', 
																			'intervalo' => '01:00:00', 
																			'ativa' => '1']);

		


	}
}
