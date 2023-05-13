<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Cursos;
use App\Models\Horarios;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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


        /*Imprimir los horarios (loop hecho antes de tener hora inicio y final)*/
        // $horarios = [];
        // for ($i = 7; $i <= 20; $i++) {
        //     $horarios[] = str_pad($i, 2, '0', STR_PAD_LEFT) . '00-' . str_pad($i + 1, 2, '0', STR_PAD_LEFT) . '00';
        // }

        return view('cursos.index', compact(['cursos_departamento', 'cursos_ciclo', 'cursos_sede']));
    }

    public function create()
    {

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')
            ->distinct()->pluck('departamento');

        $cursos_ciclo = Cursos::select('ciclo')->orderBy('ciclo', 'desc')->value('ciclo');

        $cursos_area = Areas::select('id', 'sede', 'edificio', 'area')
            ->Where(function ($query) {
                $query->whereIn('sede', ['La Normal', 'Belenes']);
            })
            ->Where(function ($query) {
                $query->whereIn('tipo_espacio', ['Laboratorio', 'Aula']);
            })->distinct()->orderBy('sede')->orderBy('edificio')
            ->get();


        // ->toSql();

        // return $cursos_area;

        $curso = new Cursos();

        return view('cursos.create', compact('cursos_departamento', 'curso', 'cursos_area', 'cursos_ciclo'));
    }

    public function store(Request $request)
    {
        $validationRules = [
            'curso_nombre' => 'required',
            'nrc' => 'required|unique:cursos,nrc',
            'ciclo' => 'required',
            'area' => 'required',
            'departamento' => 'required',
            'alumnos_registrados' => 'required',
            'nivel' => 'required',
            'profesor' => 'required',
            'codigo' => 'required',
        ];
        $customMessages = [
            'curso_nombre.required' => 'El :attribute es obligatorio',
            'nrc.required' => 'El :attribute es obligatorio',
            'ciclo.required' => 'El :attribute es obligatorio',
            'area.required' => 'El :attribute es obligatorio',
            'departamento.required' => 'El :attribute es obligatorio',
            'alumnos_registrados.required' => 'El :attribute es obligatorio',
            'nivel.required' => 'El :attribute es obligatorio',
            'profesor.required' => 'El :attribute es obligatorio',
            'codigo.required' => 'El :attribute es obligatorio',
        ];

        $request->validate($validationRules, $customMessages);
        /* Obtenemos el curso que interfiere con el horario 1*/
        $existingCourse1 = Horarios::with('curso', 'area')
            ->where('id_area', $request->area)
            ->where('dia', $request->dia[0])
            ->where(function ($query) use ($request) {
                $query->where([
                    ['hora_inicio', '<=',  $request->hora_inicio[0]],
                    ['hora_final', '>=',  $request->hora_inicio[0]],
                ])->orWhere(function ($query) use ($request) {
                    $query->where([
                        ['hora_inicio', '<=',  $request->hora_final[0]],
                        ['hora_final', '>=', $request->hora_final[0]],
                    ]);
                });
            })
            ->first();
        // dd($existingCourse1);
        /* Validamos el 2do horario en caso que lo haya */
        $existingCourse2 = null;
        if (count($request->dia) > 1) {
            $existingCourse2 = Horarios::with('curso', 'area')
                ->where('id_area', $request->area)
                ->where('dia', $request->dia[1])
                ->where(function ($query) use ($request) {
                    $query->where([
                        ['hora_inicio', '<=',  $request->hora_inicio[1]],
                        ['hora_final', '>=',  $request->hora_inicio[1]],
                    ])->orWhere(function ($query) use ($request) {
                        $query->where([
                            ['hora_inicio', '<=',  $request->hora_final[1]],
                            ['hora_final', '>=', $request->hora_final[1]],
                        ]);
                    });
                })
                ->first();
        }
        // dd($existingCourse2);
        /*Hacemos una condicion de que si hay un curso existente en la misma area y entre esas horas
            las introducimos en un array para mandar el mensaje de error*/
        $cursos = [];
        array_push($cursos, $existingCourse1 ?  $existingCourse1 : null);
        array_push($cursos, $existingCourse2 ?  $existingCourse2 : null);
        //dd($cursos);
        foreach ($cursos as $curso)
            if ($curso !== null)
                return redirect()->back()->withInput()->with(['cursosExistentes' => $cursos]);
        // return response()->json($cursos);
        /*Si no existe nigun curso entre esas horas y en la area, se crea el curso*/
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
            'dia' => $request->dia[0],
            'hora_inicio' => $request->hora_inicio[0],
            'hora_final' => $request->hora_final[0],
            'id_area' => $request->area,
        ]);
        // if ($request->dia2 != null && $request->hora_inicio2 != null && $request->hora_final2 != null) {
        if ($request->filled(['hora_inicio.1', 'hora_final.1', 'dia.1'])) {
            $curso->horarios()->create([
                'id_curso'  => $curso->id,
                'dia' => $request->dia[1],
                'hora_inicio' => $request->hora_inicio[1],
                'hora_final' => $request->hora_final[1],
                'id_area' => $request->area,

            ]);
            // return response()->json(['curso' => $curso], 200);
        }


        return redirect()->route('inicio');
    }

    public function show(Request $request)
    {
        /* Validaciones */
        $rules = ['ciclo' => 'required'];
        $validarDatos = $request->validate($rules);

        /*Consulta para ver que cursos tienen 2 horarios*/
        $horarios = Horarios::whereIn('id_curso', function ($query) {
            $query->select('id_curso')
                ->from('horarios')
                ->groupBy('id_curso')
                ->havingRaw('COUNT(id_curso) = 2');
        })->get()->toArray();


        /* Areglo que define los aributos mandados */
        $filtros = [
            'nombre' => $request->get('curso_nombre'),
            'departamento' => $request->get('departamento'),
            'sede' => $request->get('sede'),
            'ciclo' => $request->get('ciclo'),
            'dia' => $request->get('dia'),
            'horario' => $request->get('hora_inicio')
        ];

        $conditions = [
            ['column' => 'departamento', 'value' => request('departamento')],
            ['column' => 'dia', 'value' => request('dia')],
        ];

        /*Valida de que se mande un ciclo cada que se intente filtrar*/
        $cursos = Horarios::with('curso', 'area')->whereHas(
            'curso',
            function ($query) use ($request) {
                $query->where('ciclo', $request->ciclo);
            }
        );

        foreach ($conditions as $condition) {
            if ($condition['value']) {
                $cursos->whereHas('curso', function ($query) use ($condition) {
                    $query->where($condition['column'], $condition['value']);
                });
            }
        }
        /* Verificamos si el usuario ingreso un sede y se  aplica el filtro where */
        if ($request['sede']) {
            $cursos->whereHas('area', function ($query) use ($request) {
                $query->where('sede', $request['sede']);
            });
        }
        /* Verificamos si el usuario ingreso un nombre y se  aplica el filtro where */
        if ($request['curso_nombre']) {
            $cursos->whereHas('curso', function ($query) use ($request) {
                $query->where('curso_nombre', 'LIKE', '%' . $request->curso_nombre . '%');
            });
        }

        /* Verificamos si el usuario ingreso una hora de inicio  y se  aplica el filtro where */
        if ($request['hora_inicio']) {
            $cursos->where('hora_inicio', '>=', $request->hora_inicio);
        }


        $cursos = $cursos->paginate(15);
        // return $cursos;
        return view('cursos.mostrar', compact('cursos', 'filtros', 'horarios'));
    }

    public function edit(Cursos $curso)
    {
        // $curso = Cursos::findOrFail($id);
        // return view('cursos.edit', compact('curso'));

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')
            ->distinct()->pluck('departamento');

        $cursos_area = Areas::select('id', 'sede', 'edificio', 'area')
            ->orWhere(function ($query) {
                $query->where('sede', 'La Normal')
                    ->orWhere('sede', 'Belenes');
            })
            ->orWhere(function ($query) {
                $query->where('tipo_espacio', 'Laboratorio')
                    ->orWhere('tipo_espacio', 'Aula');
            })->distinct()->orderBy('sede')->orderBy('edificio')
            ->get();

        /* Solicitamos los horarios que tenga el curso */
        $horariosDelCurso = Horarios::select('horarios.*')
            ->where('id_curso', $curso->id)
            ->get();

        /*Hacemos un count para ver si tiene un horario en el mismo curso*/
        $validacion_horario = Horarios::where('id_curso', $curso->id)->count();
        // dd($validacion_horario);

        return view('cursos.edit', compact('curso', 'cursos_departamento', 'cursos_area', 'horariosDelCurso', 'validacion_horario'));
    }

    public function update(Request $request, Cursos $curso, Horarios $horario)
    {

        $curso->update($request->all());

        /* Realizamos un loop para actualizar cada horario
            en caso de que tenga mas de uno. */
        foreach ($request->horariosId as $key => $value) {
            $horario->where('id', $value)
                ->update([
                    'dia' => $request->dia[$key],
                    'hora_inicio' => $request->hora_inicio[$key],
                    'hora_final' => $request->hora_final[$key]
                ]);
        }
        $horario->where('id', $value)
            ->update([
                'id_area' => $request->area,
            ]);

        return redirect()->route('inicio');
    }

    public function destroy($id)
    {
        //
    }
}
