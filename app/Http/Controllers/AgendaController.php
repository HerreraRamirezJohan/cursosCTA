<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use App\Models\HorariosNew;

use Illuminate\Http\Request;
use App\Models\Areas;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;




use App\Http\Controllers\CursosFunctions\CursosRequest;

class AgendaController extends Controller
{

    public function index(Request $request)
    {
        $diaS = $request->dia;
        // dd($diaS);

        // dd($diaS);
        $edificioRequest = $request->edificio;

        $edificios = Areas::select('id', 'edificio', 'piso')
            ->where(function ($query) {
                $query->where('tipo_espacio', 'Laboratorio')
                    ->orWhere('tipo_espacio', 'Aula');
            })->where('activo', 1)
            ->where('sede', 'belenes')->orderBy('edificio', 'asc')->get();

        // dd($edificios);

        $aulas = Areas::select('id', 'area', 'edificio')->where('edificio', $request->edificio)
            ->where(function ($query) {
                $query->where('tipo_espacio', 'Laboratorio')
                    ->orWhere('tipo_espacio', 'Aula');
            })->where('activo', 1)->where('sede', 'belenes')->orderBy('area', 'asc')->get();

        // Función de comparación personalizada
        // if ($aulas !== null) {
        $aulas = $aulas->sortBy(function ($a) {
            $segundaPalabraA = null;
            // if ($a['area'] !== null) {
                $segundaPalabraA = intval(explode(' ', $a['area'])[1]);
            // }
            return $segundaPalabraA;
        });
        // }

        // dd($aulas);

        //Datos del aula que estan ocupados
        $horasFiltradas = [];

        foreach ($aulas as $key => $aula) {
            $horas = HorariosNew::with('curso', 'area')->select('id', 'id_area', 'id_curso', 'dia', 'hora', 'status')->where('id_area', $aula->id)->where('dia', $diaS)->
                where('status', 1)->get();
                // dd($horas);
            foreach ($horas as $key2 => $hora) {
                // print_r($hora->curso->id . '-');
                // Guaradamos en el arreglo el id y la hora de todas las aulas del edificio seleccionado
                array_push($horasFiltradas, [
                    'id' => $hora->curso->id,
                    'id_area' => $hora->id_area,
                    'area' => $hora->area->area,
                    'nrc' => $hora->curso->nrc,
                    'dia' => $hora->dia,
                    'hora' => $hora->hora,
                    'status' => $hora->status
                ]);
            }
        }

        // sort($horasFiltradas, SORT_NUMERIC);

        return view('agenda', compact('edificios', 'aulas', 'horasFiltradas', 'edificioRequest'));

        // return view('agenda', compact('edificios', 'aulas', 'resultados', 'allNrc', 'edificioRequest'));
        // return view('agenda')->with('horarios', $horarios)->with('cantidadDias', $cantidadDias);

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Horarios $horario)
    {

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}