<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoAfastamento extends Model
{
    protected $table = "documento_afastamentos";

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
