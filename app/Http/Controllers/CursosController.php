<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Cursos;
use App\Models\Horarios;
use Illuminate\Http\Request;
use Carbon\Carbon;


use App\Http\Controllers\CursosFunctions\CursosValidacion;
use App\Http\Controllers\CursosFunctions\CursosRequest;

class CursosController extends Controller
{
    public function index()
    {

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')->distinct()->pluck('departamento');

        $cursos_ciclo = Cursos::select('ciclo')->where('activo', 1)->orderBy('ciclo', 'desc')->distinct()->pluck('ciclo');

        $cursos_area = CursosRequest::getAreas();

        return view('cursos.index', compact(['cursos_departamento', 'cursos_ciclo', 'cursos_area']));
    }

    public function create(Request $request)
    {
        /*Consulta para ver que cursos tienen 2 horarios*/
        $horarios = CursosRequest::obtenerDoblesHorarios();

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')->distinct()->pluck('departamento');

        $cursos_ciclo = CursosValidacion::getCiclo();
        // dd($primerCursoDelCiclo, $tiempoTranscurrido);

        $cursos_area = CursosRequest::getAreas();

        $curso = new Cursos();

        return view('cursos.create', compact('cursos_departamento', 'curso', 'cursos_area', 'cursos_ciclo', 'horarios'));
    }

    public function store(Request $request)
    {
        /* Validamos los campos del horario */
        $errors = CursosValidacion::validateHoursAndDays($request, "store");
        if (!empty($errors))
            return back()->withInput()->with(['errorsHorario' => $errors]);

        /* Validamos que NRC y nombre sean unicos en el ciclo actual. */
        $vallidationNrcName = CursosValidacion::validateNrc($request);
        if($vallidationNrcName !== null)
            return back()->withInput()->with(['cursoMismoCiclo' => $vallidationNrcName]);
        /* Validamos si hay algun curso solapado con otro horario. */
        $cursos = CursosValidacion::validateHorario($request, "store");
        foreach ($cursos as $curso)
            if ($curso !== null)
                return back()->withInput()->with(['cursosExistentes' => $cursos]);
        
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
        $horarios = CursosRequest::obtenerDoblesHorarios();

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

        $cursos = $cursos->groupBy('id_curso')->orderBy('dia', 'asc')->get();
        // $cursos = $cursos->groupBy('id_curso')->orderBy('hora_inicio', 'asc')->paginate(10);

        $url = $request->fullUrl();
        session(['url' => $url]); // Almacenar la URL en la variable de sesión

        $lastCiclo = Cursos::select('ciclo')->where('activo', 1)->orderBy('ciclo', 'desc')->value('ciclo');
        // dd($cursos);
        // return $total;
        return view('cursos.mostrar', compact('cursos', 'filtros', 'horarios', 'lastCiclo'));
    }

    public function edit(Cursos $curso)
    {
        /*Consulta para ver que cursos tienen 2 horarios*/
        $horarios = CursosRequest::obtenerDoblesHorarios();

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')->distinct()->pluck('departamento');

        /* Valores para select de areas */
        $cursos_area = CursosRequest::getAreas();

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
        $errors = CursosValidacion::validateHoursAndDays($request, 'update');
        if (!empty($errors)) {
            return back()->withInput()->with(['errorsHorario' => $errors]);
        }
        /* Validamos si hay algun curso solapado con otro horario. */
        $cursos = CursosValidacion::validateHorario($request);
        foreach ($cursos as $item)
            if ($item !== null && $item->id_curso !== $curso->id)
                return redirect()->back()->withInput()->with(['cursosExistentes' => $cursos]);

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
                        'hora_final' => $request->hora_final[0],
                        'id_area' => $request->area,
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