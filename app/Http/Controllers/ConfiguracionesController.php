<?php

namespace App\Http\Controllers;

use App\Models\configuraciones;
use App\Models\citas;

use Illuminate\Http\Request;

class ConfiguracionesController extends Controller
{
    public static function readDay($id, $day)
    {
        $horas = [];

        $configuraciones = configuraciones::where('id_evento', $id)->where('dia', $day)->get();

        $citas = citas::where('id_evento', $id)
            ->where('dia', $day)
            ->get();

        $numReservas = 0;
        foreach ($citas as $key => $value) {
            $numReservas++;
        }
        $numReservas = $configuraciones[0]->numero_citas - $numReservas;
        if ($numReservas <= 0) {
            $data = array(
                'numero_citas' => $numReservas,
                'horas' => null,
            );
            return $data;
        }

        for ($i = $configuraciones[0]->hora_inicio; $i < $configuraciones[0]->hora_fin; $i++) {
            $cont = 0;
            foreach ($citas as $key => $value) {
                if ($i == $value->cita_hora) {
                    $cont++;
                }
            }
            if ($cont >= 2) {
                //echo $i, " se repitio: ", $cont;
                //echo "<br>";
                $element = array(
                    'hora' => $i,
                    'disponible' => false
                );
            } else {
                $element = array(
                    'hora' => $i,
                    'disponible' => true
                );
            }
            array_push($horas, $element);
        };
        $data = array(
            'numero_citas' => $numReservas,
            'horas' => $horas,
        );
        return $data;
    }
}
