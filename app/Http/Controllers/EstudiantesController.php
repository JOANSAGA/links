<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estudiantes;

class EstudiantesController extends Controller
{
    public static function inicialCreate($user)
    {
        estudiantes::create([
            'nombre' => $user['name'],
            'correo' => $user['email'],
            'carrera' => 1,
            'semestre' => 10,
            'id_user' => $user['id']
        ]);
    }
}
