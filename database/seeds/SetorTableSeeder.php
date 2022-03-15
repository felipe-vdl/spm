<?php

use Illuminate\Database\Seeder;

class SetorTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		DB::table('setor_escalas')->insert(['setor' => 'COODENADOR DISTRITAL', 'tipo_escala_id' => '1']);
		DB::table('setor_escalas')->insert(['setor' => 'PRAÇA LIZABETH PAIXÃO (O.S SÃO JOSÉ)', 'tipo_escala_id' => '1']);
		DB::table('setor_escalas')->insert(['setor' => 'PRAÇA JOÃO LUIZ DO NASCIMENTO (O.S DRIVE IN)', 'tipo_escala_id' => '1']);
		DB::table('setor_escalas')->insert(['setor' => 'COVID - VILA OLIMPICA (O.S ULTRAIMAGEM)', 'tipo_escala_id' => '1']);
		DB::table('setor_escalas')->insert(['setor' => 'PRAÇA PEC (O.S JACUTINGA)', 'tipo_escala_id' => '1']);
		DB::table('setor_escalas')->insert(['setor' => 'BASE', 'tipo_escala_id' => '1']);
		DB::table('setor_escalas')->insert(['setor' => 'PROCURADORIA', 'tipo_escala_id' => '1']);
		DB::table('setor_escalas')->insert(['setor' => 'PREFEITURA GABINETE / TÉRREO / IPTU', 'tipo_escala_id' => '1']);
		DB::table('setor_escalas')->insert(['setor' => 'GRE (DRIVE SAÍDA)(ORDEM PÚBLICA)', 'tipo_escala_id' => '1']);
		DB::table('setor_escalas')->insert(['setor' => 'GAM (DRIVE SAÍDA)(ORDEM PÚBLICA)', 'tipo_escala_id' => '1']);
		
		DB::table('setor_escalas')->insert(['setor' => 'PERMANÊNCIA OPERACIONAL', 'tipo_escala_id' => '2']);
		DB::table('setor_escalas')->insert(['setor' => 'GRUPAMENTO NOTURNO', 'tipo_escala_id' => '2']);
		
		DB::table('setor_escalas')->insert(['setor' => 'APOIO LOGISTICA / ADM', 'tipo_escala_id' => '3']);

		DB::table('setor_escalas')->insert(['setor' => 'SEMAS', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'PROCURADORIA PMM', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'PREFEITURA GABINETE / TERREO / IPTU', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'ABRIGO ANDREA GUIMARÃES', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'COMANDANTE', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'SUBCOMANDANTE', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'DIRETORIA DE PESSOAL', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'DIRETORIA DE OPERAÇÕES', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'DIRETORIA DE LOGISTICA', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'DIRETORIA DE INTELIGÊNCIA', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'COORDENADORIA DE ENSINO E INSTRUÇÃO', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'COORDENADORIA DE MEIO AMBIENTE (GAM)', 'tipo_escala_id' => '4']);
		DB::table('setor_escalas')->insert(['setor' => 'COORDENADORIA DE RONDA ESCOLAR (GRE)', 'tipo_escala_id' => '4']);


	}
}
