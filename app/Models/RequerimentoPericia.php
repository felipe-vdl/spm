<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequerimentoPericia extends Model
{
    protected $fillable = [
        'nome', 
        'matricula', 
        'protocolo',
        'local_lotacao', 
        'horario_trabalho', 
        'dt_inicio_atestado',
        'email',
        'status',
        'direcionamento',
        'data_agenda',
        'hora_agenda',
        'motivo_recusa',
        'justificativa_reagenda',
        'data_confirmacao',
        'data_avaliacao',
        'data_pedidoreagenda',
        'data_reagenda',
        'data_reagendada',
        'hora_reagendada',
        'data_confirmacaoreagenda',
        'justificativa_cancelamento',
        'observacao',
        'observacao_reagenda',
        'quant_reagendas',
        'user_id',
        'envio_create',
        'envio_agenda',
        'envio_reagenda',
        'presenca',
        'vinculo'
    ];

    public function doc_atestado()
   {
      return $this->hasMany(DocumentoAtestado::class, 'requerimento_id');
   }

    public function doc_afastamento()
   {
      return $this->hasMany(DocumentoAfastamento::class, 'requerimento_id');
   }

    public function user()
   {
      return $this->belongsTo(User::class);
   }
}