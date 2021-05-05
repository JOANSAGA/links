<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventos;
use App\Models\configuraciones;

class EventosController extends Controller
{
    public static function readAll()
    {
        return eventos::all();
    }
    public static function readOne($id)
    {
        $data = configuraciones::where('id_evento', $id)->get();
        return $data;
    }
}
