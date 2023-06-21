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

        // dd($aulas);

        $horasFiltradas = [];

        foreach ($aulas as $key => $aula) {
            // dd($aula->id);
            $horas = HorariosNew::with('curso')->select('id_area', 'id_curso', 'dia', 'hora', 'status')->where('id_area', $aula->id)->where('dia', 'lunes')->
                where('status', 1)->get();
            foreach ($horas as $key2 => $hora) {
                // dd($hora->curso);
                // Guaradamos en el arreglo el id y la hora de todas las aulas del edificio seleccionado
                array_push($horasFiltradas, [
                    'nrc' => $hora->curso->nrc,
                    'hora' => $hora->hora,
                    'id' => $hora->id_area,
                    'area' => $hora->area->area,
                    'status' => $hora->status
                ]);
            }
        }


        // dd($horasFiltradas);

        $areas = [];
        $horasPorArea = [];
        $cursos = [];

        foreach ($horasFiltradas as $key3 => $value2) {
            $hora = $value2['hora'];
            $idArea = $value2['id'];
            $nrc = $value2['nrc'];

            if (!in_array($idArea, $areas)) {
                $areas[] = $idArea;
            }
            if (!isset($horasPorArea[$idArea])) {
                $horasPorArea[$idArea] = [];
            }
            $horasPorArea[$idArea][] = $hora;

            if (!isset($cursos[$idArea])) {
                $cursos[$idArea] = [];
            }
            $cursos[$idArea][] = $nrc;

            // dd($idArea);
        }

        // dd($cursos, $horasPorArea);

        $resultados = [];


        foreach ($areas as $key5 => $area) {
            // dd($areas);
            $resultados[] = [
                'id_area' => $area,
                'nrc' => $cursos[$area],
                'horas' => $horasPorArea[$area]
            ];
        }
        // dd($horasPorArea, $cursos);

        // ->get();

        
        $allNrc = [];

        foreach ($resultados as $index => $resultado) {
            // dd($resultado['nrc']);
            $allNrc[] = $resultado['nrc'];
        }

        // dd($allNrc, $resultados );
        // dd($resultados);

        // $horarios = Areas::select('id', 'area')->where('edificio', 'Edificio H')
        // ->where(function ($query) {
        //     $query->where('tipo_espacio', 'Laboratorio')
        //         ->orWhere('tipo_espacio', 'Aula');
        // })
        // ->where('piso', 'Planta Baja')->where('sede', 'Belenes')->get();
        // // dd($horarios);

        // $cantidadDias = $horarios->count();

        // dd($cantidadDias);


        return view('agenda', compact('edificios', 'aulas', 'resultados', 'allNrc'));
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
        // $aulas = Areas::select('id','area', 'edificio')->where('edificio', $request->edificio)->get();
        // dd($aulas);
        // $agenda = DB::table('agenda')->get();

        $horarios = HorariosNew::select('hora')->where('dia', 'lunes')->get();



        foreach ($horarios as $key => $value) {
            $hora = $value->hora;
            $horaConverted = Carbon::createFromTimestamp($hora);


            $timestamp = $horaConverted->timestamp;


            // echo $timestamp;
            // dd($timestamp);
        }
        $var = response()->json($timestamp);
        dd($var);


        // return response()->json($agenda);
    }


    public function edit($id)
    {
        //
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