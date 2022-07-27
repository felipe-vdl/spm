<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direcionamento extends Model
{
    protected $fillable = [
        'nome',
        'config',
    ];
}
