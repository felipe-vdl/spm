<?php

use Illuminate\Database\Seeder;

class DirecionamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $atendimentoPericial = '[
          {"dia": "Domingo", "isOn": 0, "index": 0, "inicio": "", "fim": ""},
          {"dia": "Segunda", "isOn": 0, "index": 1, "inicio": "", "fim": ""},
          {"dia": "Terça", "isOn": 0, "index": 2, "inicio": "", "fim": ""},
          {"dia": "Quarta", "isOn": 1, "index": 3, "inicio": "9:00", "fim": "9:00"},
          {"dia": "Quinta", "isOn": 1, "index": 4, "inicio": "13:00", "fim": "13:00"},
          {"dia": "Sexta", "isOn": 0, "index": 5, "inicio": "", "fim": ""},
          {"dia": "Sábado", "isOn": 0, "index": 6, "inicio": "", "fim": ""}
        ]';
        
        $avaliacaoPsiquiatrica = '[
          {"dia": "Domingo", "isOn": 0, "index": 0, "inicio": "", "fim": ""},
          {"dia": "Segunda", "isOn": 1, "index": 1, "inicio": "8:00", "fim": "10:00"},
          {"dia": "Terça", "isOn": 0, "index": 2, "inicio": "", "fim": ""},
          {"dia": "Quarta", "isOn": 1, "index": 3, "inicio": "8:00", "fim": "10:00"},
          {"dia": "Quinta", "isOn": 0, "index": 4, "inicio": "", "fim": ""},
          {"dia": "Sexta", "isOn": 0, "index": 5, "inicio": "", "fim": ""},
          {"dia": "Sábado", "isOn": 0, "index": 6, "inicio": "", "fim": ""}
        ]';

        $juntaMedica = '[
          {"dia": "Domingo", "isOn": 0, "index": 0, "inicio": "", "fim": ""},
          {"dia": "Segunda", "isOn": 1, "index": 1, "inicio": "8:00", "fim": "9:00"},
          {"dia": "Terça", "isOn": 0, "index": 2, "inicio": "", "fim": ""},
          {"dia": "Quarta", "isOn": 1, "index": 3, "inicio": "8:00", "fim": "9:00"},
          {"dia": "Quinta", "isOn": 0, "index": 4, "inicio": "", "fim": ""},
          {"dia": "Sexta", "isOn": 0, "index": 5, "inicio": "", "fim": ""},
          {"dia": "Sábado", "isOn": 0, "index": 6, "inicio": "", "fim": ""}
        ]';

        DB::table('direcionamentos')->insert([
            [ 'nome' => 'Atendimento Pericial', 'config' => $atendimentoPericial],
            [ 'nome' => 'Avaliação Psiquiátrica', 'config' => $avaliacaoPsiquiatrica],
            [ 'nome' => 'Junta Médica', 'config' => $juntaMedica],
        ]);
    }
}
