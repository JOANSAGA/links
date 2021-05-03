<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class citas extends Model
{
    protected $fillable = [
        'cita_hora',
        'cita_numero',
        'id_estudiante',
        'id_evento',
    ];
}
