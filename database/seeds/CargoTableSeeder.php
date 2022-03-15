<?php

use Illuminate\Database\Seeder;

class CargoTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('cargos')->insert(['cargo' => 'COMANDANTE GERAL', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'COMANDANTE_GERAL', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'SUBCOMANDANTE GERAL', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'SUBCOMANDANTE_GERAL', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'SUBSECRETÁRIO MUNICIPAL DE ORDEM PÚBLICA', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'SUBSECRETÁRIO_MUNICIPAL_DE_ORDEM_PÚBLICA', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'SUBSECRETÁRIO MUNICIPAL DE SEGURANÇA, ORDEM PÚBLICA E CIDADANIA', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'SUBSECRETÁRIO_MUNICIPAL_DE_SEGURANÇA,_ORDEM_PÚBLICA_E_CIDADANIA', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'CHEFE DO SETOR DE CONTROLE E OCUPAÇÃO', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'CHEFE_DO_SETOR_DE_CONTROLE_E_OCUPAÇÃO', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'COORDENADOR DE ENSINO E INSTRUÇÃO', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'COORDENADOR_DE_ENSINO_E_INSTRUÇÃO', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'COORDENADOR DE PATRULHA AMBIENTAL', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'COORDENADOR_DE_PATRULHA_AMBIENTAL', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'COORDENADOR DE PATRULHA ESCOLAR', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'COORDENADOR_DE_PATRULHA_ESCOLAR', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'COORDENADOR DISTRITAL', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'COORDENADOR_DISTRITAL', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'DIRETOR DE INTELIGÊNCIA', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'DIRETOR_DE_INTELIGÊNCIA', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'DIRETOR DE LOGÍSTICA', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'DIRETOR_DE_LOGÍSTICA', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'DIRETOR DE OPERAÇÕES', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'DIRETOR_DE_OPERAÇÕES', 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'DIRETOR DE PESSOAL', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'DIRETOR_DE_PESSOAL, 'sistema_id' => '11']);
		
		DB::table('cargos')->insert(['cargo' => 'GERENTE DE FISCALIZAÇÃO', 'quantidade' => '1']);
		//DB::connection('mysql_sisseg')->table('roles')->insert(['nome' => 'GERENTE_DE_FISCALIZAÇÃO', 'sistema_id' => '11']);
		

	}
}
