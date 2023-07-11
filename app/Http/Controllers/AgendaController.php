<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use App\Models\HorariosNew;

use Illuminate\Http\Request;
use App\Models\Areas;
use App\Models\Cursos;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;




use App\Http\Controllers\CursosFunctions\CursosRequest;

class AgendaController extends Controller
{

    public function index(Request $request)
    {
        //Traer todos los ciclos
        $cursos_ciclo = Cursos::select('ciclo')->where('activo', 1)->orderBy('ciclo', 'desc')->distinct()->pluck('ciclo');

        $diaS = $request->dia;
        $edificioRequest = $request->edificio;

        $edificios = Areas::select('id', 'edificio', 'piso')
            ->where(function ($query) {
                $query->where('tipo_espacio', 'Laboratorio')
                    ->orWhere('tipo_espacio', 'Aula');
            })->where('activo', 1)
            ->where('sede', 'belenes')->orderBy('edificio', 'asc')->get();


        $aulas = Areas::select('id', 'area', 'edificio')->where('edificio', $request->edificio)
            ->where(function ($query) {
                $query->where('tipo_espacio', 'Laboratorio')
                    ->orWhere('tipo_espacio', 'Aula');
            })->where('activo', 1)->where('sede', 'belenes')->orderBy('area', 'asc')->get();

        // Función de comparación personalizada para separar el nombre de las aulas
            $aulas = $aulas->sortBy(function ($a) {
                $segundaPalabraA = null;
                if ($a['area'] !== null) {
                    $palabras = explode(' ', $a['area']);
                    if (count($palabras) > 1) {
                        $segundaPalabraA = intval($palabras[1]);
                    }
                }
                return $segundaPalabraA;
            });
            
        //Datos del aula que estan ocupados
        $horasFiltradas = [];

        foreach ($aulas as $key => $aula) {
                $horas = HorariosNew::with('curso', 'area')->select('id', 'id_area', 'id_curso', 'dia', 'hora', 'status')
                ->whereHas('curso', function ($query) use ($request) {
                        $query->where('ciclo', $request->ciclo);}
                )->where('id_area', $aula->id)->where('dia', $diaS)->where('status', 1)->get();
                foreach ($horas as $key2 => $hora) {
                // Guaradamos en el arreglo el id y la hora de todas las aulas del edificio seleccionado
                array_push($horasFiltradas, [
                    'id' => $hora['curso']->id,
                    'id_area' => $hora->id_area,
                    'area' => $hora['area']->area,
                    'nrc' => $hora['curso']->nrc,
                    'dia' => $hora->dia,
                    'hora' => $hora->hora,
                    'status' => $hora->status
                ]);
            }
        }


        $url = $request->fullUrl();
        session(['url' => $url]); // Almacenar la URL en la variable de sesión

        // sort($horasFiltradas, SORT_NUMERIC);

        return view('agenda', compact('edificios', 'aulas', 'horasFiltradas', 'edificioRequest', 'cursos_ciclo'));

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