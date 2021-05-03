<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configuraciones extends Model
{
    protected $fillable = [
        'dia',
        'numero_citas',
        'hora_inicio',
        'hora_fin',
        'id_evento'
    ];
}
