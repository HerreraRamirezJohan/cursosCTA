<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Cursos;
use App\Models\Horarios;
use Illuminate\Http\Request;
use Carbon\Carbon;


use App\Http\Controllers\CursosValidacion;

class CursosController extends Controller
{
    public function index()
    {

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')
            ->distinct()->pluck('departamento');

        $cursos_ciclo = Cursos::select('ciclo')->orderBy('ciclo', 'desc')
            ->distinct()->pluck('ciclo');

        $cursos_area = Areas::select('id', 'sede', 'edificio', 'area')
            ->Where(function ($query) {
                $query->whereIn('sede', ['La Normal', 'Belenes']);
            })
            ->Where(function ($query) {
                $query->whereIn('tipo_espacio', ['Laboratorio', 'Aula']);
            })->distinct()->orderBy('sede')->orderBy('edificio')->orderBy('area')
            ->get();

        return view('cursos.index', compact(['cursos_departamento', 'cursos_ciclo', 'cursos_area']));
    }

    public function create(Request $request)
    {
        /*Consulta para ver que cursos tienen 2 horarios*/
        $horarios = Horarios::whereIn('id_curso', function ($query) {
            $query->select('id_curso')
                ->from('horarios')
                ->groupBy('id_curso')
                ->havingRaw('COUNT(id_curso) >= 2');
        })->get()->toArray();

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')
            ->distinct()->pluck('departamento');

        $cursos_ciclo = Cursos::select('ciclo')->orderBy('ciclo', 'desc')->value('ciclo');

        /*Consulta para ver la diferencia de tiempos desde el ultimno curso creado*/
        $primerCursoDelCiclo = Cursos::where('ciclo', $cursos_ciclo)->where('created_at', '!=', null)->orderBy('created_at', 'asc')->first();
        $primerCursoDelCiclo = $primerCursoDelCiclo->created_at;
        $tiempoTranscurrido = $primerCursoDelCiclo->diffForHumans();
        // dd($tiempoTranscurrido);

        $cursos_area = Areas::select('id', 'sede', 'edificio', 'area')
            ->Where(function ($query) {
                $query->whereIn('sede', ['La Normal', 'Belenes']);
            })
            ->Where(function ($query) {
                $query->whereIn('tipo_espacio', ['Laboratorio', 'Aula']);
            })->distinct()->orderBy('sede')->orderBy('edificio')->orderBy('area')
            ->get();

        $curso = new Cursos();

        return view('cursos.create', compact('cursos_departamento', 'curso', 'cursos_area', 'cursos_ciclo', 'horarios', 'tiempoTranscurrido'));
    }

    public function store(Request $request)
    {
        /* Validamos los campos del horario */
        $errors = CursosValidacion::validateHoursAndDays($request, "store");
        if (!empty($errors)) {
            return back()->withInput()->with(['errorsHorario' => $errors]);
        }
        /* Validamos si hay algun curso solapado con otro horario. */
        $cursos = CursosValidacion::validateHorario($request, "store");
        foreach ($cursos as $curso)
            if ($curso !== null)
                return redirect()->back()->withInput()->with(['cursosExistentes' => $cursos]);
        /*Validamos que los alumnos registrados no puedan ser mayor al cupo del curso*/
        if ($request->alumnos_registrados > $request->cupo) {
            return back()->withInput()->with('alumnosMayor', 'El número de alumnos registrados sobrepasa el cupo del curso');
        }
        
        /* Creamos El curso con su primer horario */
        $curso = Cursos::create([
            'nrc' => $request->nrc,
            'curso_nombre' => $request->curso_nombre,
            'ciclo' => $request->ciclo,
            'observaciones' => $request->observaciones,
            'departamento' => $request->departamento,
            'alumnos_registrados' => $request->alumnos_registrados,
            'cupo' => $request->cupo,
            'nivel' => $request->nivel,
            'profesor' => $request->profesor,
            'codigo' => $request->codigo,
        ]);
        $curso->horarios()->create([
            'dia' => $request->dia[0],
            'hora_inicio' => $request->hora_inicio[0],
            'hora_final' => $request->hora_final[0],
            'id_area' => $request->area,
        ]);
        /* La validacion del segundo horario se realiza en el metodo  CursosValidacion::validateHoursAndDays*/
        /* Validamos solo si existe para crearlo. */
        if ($request->filled(['hora_inicio.1', 'hora_final.1', 'dia.1'])) {
            $curso->horarios()->create([
                'id_curso' => $curso->id,
                'dia' => $request->dia[1],
                'hora_inicio' => $request->hora_inicio[1],
                'hora_final' => $request->hora_final[1],
                'id_area' => $request->area,
            ]);
        }

        return redirect()->route('inicio')->with('cursoCreado', 'Curso creado exitosamente.');
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
                ->havingRaw('COUNT(id_curso) >= 2');
        })->get()->toArray();


        /* Areglo que define los aributos mandados */
        $filtros = [
            'nombre' => $request->get('curso_nombre'),
            'departamento' => $request->get('departamento'),
            'sede' => $request->get('sede'),
            'ciclo' => $request->get('ciclo'),
            'dia' => $request->get('dia'),
            'horario' => $request->get('hora_inicio'),
        ];

        $conditions = [
            ['column' => 'departamento', 'value' => request('departamento')],
            ['column' => 'dia', 'value' => request('dia')],
            ['column' => 'activo', 'value' => 1],
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
        if ($request['area']) {
            $cursos->whereHas('area', function ($query) use ($request) {
                $query->where('id', $request['area']);
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

        $cursos = $cursos->join('cursos', 'horarios.id_curso', '=', 'cursos.id')
                 ->orderBy('cursos.curso_nombre')
                 ->groupBy('horarios.id_curso')
                 ->paginate(10);

        $url = $request->fullUrl();
        session(['url' => $url]); // Almacenar la URL en la variable de sesión


        // dd($cursos);
        // return $total;
        return view('cursos.mostrar', compact('cursos', 'filtros', 'horarios'));
    }

    public function edit(Cursos $curso)
    {
        // $curso = Cursos::findOrFail($id);
        // return view('cursos.edit', compact('curso'));
        /*Consulta para ver que cursos tienen 2 horarios*/
        $horarios = Horarios::whereIn('id_curso', function ($query) {
            $query->select('id_curso')
                ->from('horarios')
                ->groupBy('id_curso')
                ->havingRaw('COUNT(id_curso) >= 2');
        })->get()->toArray();

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

        /* Solicitamos los horarios que tenga el curso y esten activos*/
        $horariosDelCurso = Horarios::select('horarios.*')
        ->where('id_curso', $curso->id)->where('estado', 1)
        ->get();



        /*Hacemos un count para ver si tiene un horario en el mismo curso*/
        $validacion_horario = Horarios::where('id_curso', $curso->id)->where('estado', 1)->count();
        return view('cursos.edit', compact('curso', 'cursos_departamento', 'cursos_area', 'horariosDelCurso', 'validacion_horario', 'horarios'));
    }

    public function update(Request $request, Cursos $curso, Horarios $horario)
    {
        /* Validamos los campos del horario */
        $errors = CursosValidacion::validateHoursAndDays($request);
        if (!empty($errors)) {
            return back()->withInput()->with(['errorsHorario' => $errors]);
        }
        /* Validamos si hay algun curso solapado con otro horario. */
        $cursos = CursosValidacion::validateHorario($request);
        foreach ($cursos as $item)
            if ($item !== null && $item->id_curso !== $curso->id)
                return redirect()->back()->withInput()->with(['cursosExistentes' => $cursos]);
        /*Validamos que los alumnos registrados no puedan ser mayor al cupo del curso*/
        if ($request->alumnos_registrados > $request->cupo) {
            return back()->withInput()->with('alumnosMayor', 'El número de alumnos registrados sobrepasa el cupo del curso');
        }

        /* Actualizamos el curso despues de sus validacoines */
        $curso->update($request->all());

        if (count($request->horariosId) > 1) { /* Si el curso cuenta con mas de 1 horario realizamos un loop para realizar sus actualizaciones */
            foreach ($request->horariosId as $key => $value) {
                $horario->where('id', $value)
                    ->update(
                        [
                            'dia' => $request->dia[$key],
                            'hora_inicio' => $request->hora_inicio[$key],
                            'hora_final' => $request->hora_final[$key]
                        ]
                    );

                $horario->where('id', $value)
                    ->update([
                        'id_area' => $request->area,
                    ]);
            }
        } else {
            /* Actualizamos el primero y creamos el segundo */
            $horario->where('id', $request->horariosId[0])
                ->update(
                    [
                        'dia' => $request->dia[0],
                        'hora_inicio' => $request->hora_inicio[0],
                        'hora_final' => $request->hora_final[0]
                    ]
                );
            /*Validamos si el usuario creo un segundo horario en editar*/
            if ($request->filled(['hora_inicio.1', 'hora_final.1', 'dia.1'])) {
                Horarios::create([
                    'id_curso' => $curso->id,
                    'dia' => $request->dia[1],
                    'hora_inicio' => $request->hora_inicio[1],
                    'hora_final' => $request->hora_final[1],
                    'id_area' => $request->area,

                ]);
            }
        }

        return redirect()->back()->with('cursoModificado', 'Curso modificado correctamente.');
    }

    public function destroy($id)
    {
        // dd($id);
        $eliminar = Cursos::findOrFail($id);
        $eliminar->update(['activo' => 0]);

        return back()->with('success', 'Curso eliminado correctamente');
    }

    public function destroyHorario($id)
    {
        $eliminar_horario = Horarios::findOrFail($id);
        $eliminar_horario->update(['estado' => 0]);

        return back()->with('success', 'Horario eliminado correctamente');
    }


}