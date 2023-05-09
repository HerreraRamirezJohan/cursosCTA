<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Cursos;
use App\Models\Horarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class CursosController extends Controller
{

    public function index()
    {

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')
            ->distinct()->pluck('departamento');

        $cursos_ciclo = Cursos::select('ciclo')->orderBy('ciclo', 'desc')
            ->distinct()->pluck('ciclo');

        $cursos_sede = Areas::select('sede')->orderBy('sede', 'asc')
            ->distinct()->pluck('sede');

        $horarios = [];
        for ($i = 7; $i <= 20; $i++) {
            $horarios[] = str_pad($i, 2, '0', STR_PAD_LEFT) . '00-' . str_pad($i + 1, 2, '0', STR_PAD_LEFT) . '00';
        }

        return view('cursos.index', compact(['cursos_departamento', 'cursos_ciclo', 'cursos_sede', 'horarios']));
    }

    public function create()
    {

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')
            ->distinct()->pluck('departamento');

        $cursos_areas = Areas::select('id','sede', 'edificio', 'area')
            ->orWhere(function ($query) {
                $query->where('sede', 'La Normal')
                    ->orWhere('sede', 'Belenes');
            })
            ->orWhere(function ($query) {
                $query->where('tipo_espacio', 'Laboratorio')
                    ->orWhere('tipo_espacio', 'Aula');
            })->distinct()
            ->get();


        // ->toSql();

        // return $cursos_area;

        $curso = new Cursos();

        return view('cursos.create', compact('cursos_departamento', 'curso', 'cursos_areas'));
    }

    /* Metodo que devuelve un mensaje con la validacion del formulario cursos con JS*/
    public static function validateForm(Request $request){
        $horario_disponible = Cursos::select(DB::raw('count(*) as total, cursos.id'))
                                    ->join('horarios', 'cursos.id', '=', 'horarios.id_curso')
                                    ->join('areas', 'horarios.id_area', '=', 'areas.id')
                                    ->where('dia', $request->dia)
                                    ->where('ciclo', $request->ciclo)
                                    ->where('areas.id', $request->area)
                                    ->where(function($query) use ($request) {
                                        $query->where([
                                            ['hora_inicio', '<=',  $request->hora_inicio],
                                            ['hora_final', '>=',  $request->hora_inicio],
                                        ])->orWhere(function($query) use ($request) {
                                            $query->where([
                                                ['hora_inicio', '<=',  $request->hora_final],
                                                ['hora_final', '>=', $request->hora_final],
                                            ]);
                                        });
                                    })
                                    // ->toSql();
                                    ->first();
        
        if(!$horario_disponible->total){
            return true; //Esta libre el horario para almacenarlo.
        }else{
            $curso_solapado = Cursos::select('cursos.*', 'areas.*', 'horarios.*')
            ->join('horarios', 'cursos.id', '=', 'horarios.id_curso')
            ->join('areas', 'horarios.id_area', '=', 'areas.id')
            ->where('cursos.id', $horario_disponible->id)
            ->first();

            return $curso_solapado; //No esta libre y mandamos el curso que esta ocupando ese horario.
        }

    }
    public function store(Request $request)
    {
        $curso = Cursos::create([
            'nrc'                   => $request->nrc,
            'curso_nombre'          => $request->curso_nombre,
            'ciclo'                 => $request->ciclo,
            'observaciones'         => $request->observaciones,
            'departamento'          => $request->departamento,
            'alumnos_registrados'   => $request->alumnos_registrados,
            'nivel'                 => $request->nivel,
            'profesor'              => $request->profesor,
            'codigo'                => $request->codigo,
        ]);

        $curso->horarios()->create([
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_final' => $request->hora_final,
        ]);

        return redirect()->route('inicio');
        // return redirect('inicio')->with('msg', 'Empleado agregado exitosamente.');


    }

    public function show(Request $request)
    {
        $rules = ['ciclo' => 'required'];

        $validarDatos = $request->validate($rules);


        // $nombre = $request->get('curso_nombre');
        // $departamento = $request->get('departamento');
        // $sede = $request->get('sede');
        // $ciclo = $request->get('ciclo');
        // $dia = $request->get('dia');
        // $horario = $request->get('horario');

        $filtros = [
            'nombre' => $request->get('curso_nombre'),
            'departamento' => $request->get('departamento'),
            'sede' => $request->get('sede'),
            'ciclo' => $request->get('ciclo'),
            'dia' => $request->get('dia'),
            'horario' => $request->get('hora_inicio')
        ];


        $cursos = Cursos::select('cursos.*', 'areas.*', 'horarios.*')
            ->join('horarios', 'cursos.id', '=', 'horarios.id_curso')
            ->join('areas', 'horarios.id_area', '=', 'areas.id')
            ->when($filtros['nombre'], function ($query, $nombre) {
                return $query->where('curso_nombre', 'LIKE', "%" . $nombre . "%");
            })
            ->when($filtros['departamento'], function ($query, $departamento) {
                return $query->where('departamento', $departamento);
            })
            ->when($filtros['sede'], function ($query, $sede) {
                return $query->where('sede', $sede);
            })
            ->when($filtros['ciclo'], function ($query, $ciclo) {
                return $query->where('ciclo', $ciclo);
            })
            ->when($filtros['dia'], function ($query, $dia) {
                return $query->where('dia', $dia);
            })
            ->when($filtros['horario'], function ($query, $horario) {
                return $query->where('hora_inicio', '>=', $horario);
            })->orderBy('curso_nombre')
            ->paginate(15);

        // ->get();
        // ->toSql();



        // return $cursos;
        // return view('cursos.mostrar', compact('cursos')); 
        return view('cursos.mostrar', compact('cursos', 'filtros'));
    }

    public function edit(Cursos $curso, Horarios $horario)
    {
        // $curso = Cursos::findOrFail($id);
        // return view('cursos.edit', compact('curso'));

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')
            ->distinct()->pluck('departamento');

        $cursos_area = Areas::select('area')->orderBy('area', 'asc')
            ->distinct()->pluck('area');

        return view('cursos.edit', compact('curso', 'cursos_departamento', 'horario', 'cursos_area'));
    }

    public function update(Request $request, Cursos $curso, Horarios $horario)
    {
        $curso->update($request->all());
        $horario->update($request->all());

        return redirect()->route('inicio');
    }

    public function destroy($id)
    {
        //
    }
}
