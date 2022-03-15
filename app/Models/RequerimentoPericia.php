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
        'status',
        'data_avaliazao',
        'motivo_recusa',
        'direcionamento',
        'agendamento',
        'user_id',
        'envio_create',
        'envio_agenda',
        'email'
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