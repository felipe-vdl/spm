<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoAtestado extends Model
{
    protected $table = "documento_atestados";

    protected $fillable = [
        'requerimento_id',
        'filename',
        'extensao',
       ];
 
       public function requerimento()
     {
       return $this->belongsTo(RequerimentoPericia::class);
     }
}
