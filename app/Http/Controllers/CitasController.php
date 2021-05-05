<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\citas;

use Illuminate\Http\Request;

class CitasController extends Controller
{
    public static function reservar()
    {
        $cont = 0;
        $citas = citas::where('id_evento', request('evento'))
            ->where('dia', request('dia'))
            ->where('cita_hora', request('hora'))
            ->get();
        foreach ($citas as $key => $value) {
            $cont = $cont + $value->cita_numero;
        }
        if ($cont >= 2) {
            return "reservaciones exedidas para la hora indicada";
        } else {
            citas::create([
                'cita_hora' => request('hora'),
                'cita_numero' => 1,
                'dia' => request('dia'),
                'id_estudiante' => Auth::id(),
                'id_evento' => request('evento'),
            ]);
        }
    }
}
