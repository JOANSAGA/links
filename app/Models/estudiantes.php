<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudiantes extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'id_carrera',
        'semestre',
        'id_user'
    ];
}
