<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Cursos;
use App\Models\Horarios;
use App\Models\HorariosNew;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use DateTime;


use App\Http\Controllers\CursosFunctions\CursosValidacion;
use App\Http\Controllers\CursosFunctions\CursosRequest;

class CursosController extends Controller
{
    public function index()
    {

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')->distinct()->pluck('departamento');
        $cursos_ciclo = Cursos::select('ciclo')->where('activo', 1)->orderBy('ciclo', 'desc')->distinct()->pluck('ciclo');
        $cursos_area = CursosRequest::getAreas();

        $url = route('inicio');
        session(['url' => $url]); // Almacenar la URL en la variable de sesión

        return view('cursos.index', compact('cursos_departamento', 'cursos_ciclo', 'cursos_area'));
    }

    public function create(Request $request, $hour = null, $aula = null, $dia = null)
    {
        /*Consulta para ver que cursos tienen 2 horarios*/
        $horarios = CursosRequest::obtenerDoblesHorarios();

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')->distinct()->pluck('departamento');

        $cursos_ciclo = CursosValidacion::getCiclo();
        // dd($primerCursoDelCiclo, $tiempoTranscurrido);

        $cursos_area = CursosRequest::getAreas();

        $curso = new Cursos();

        $lastCiclo = Cursos::select('ciclo')->where('activo', 1)->orderBy('ciclo', 'desc')->value('ciclo');

        return view('cursos.create', compact('cursos_departamento', 'curso', 'cursos_area', 'horarios', 'lastCiclo', 'cursos_ciclo'));
    }

    public function store(Request $request)
    {
        /* Validamos los campos del horario */
        $errors = CursosValidacion::validateHoursAndDays($request, "store");
        if (!empty($errors))
            return back()->withInput()->with(['errorsHorario' => $errors]);

        /* Validamos que NRC y nombre sean unicos en el ciclo actual. */
        $vallidationNrcName = CursosValidacion::validateNrc($request, null);
        if ($vallidationNrcName !== null)
            return back()->withInput()->with(['cursoMismoCiclo' => $vallidationNrcName]);
        /* Validamos si hay algun curso solapado con otro horario. */
        $cursos = CursosValidacion::validateHorario($request, "store");
        foreach ($cursos[0] as $curso)
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

        /*Creamos los horarios*/
        // HorariosNew::where('id_curso', $curso->id)->update(['id_curso' => null, 'status' => 0]);
        foreach ($request->dia as $key => $value) {
            $start = (int) $request->hora_inicio[$key];
            // dd($request->hora_final[$key]);
            /*Validamos que si los minutos son igual a cero que les reste 5 minutos*/
            if (Carbon::parse($request->hora_final[$key])->minute === 0) {
                $newEndTime = Carbon::parse($request->hora_final[$key])->subMinutes(5)->format('H:i');
                // dd($newEndTime);
                $end = (int) $newEndTime;
            } else {
                $end = (int) $request->hora_final[$key];
            }
            // dd($start, $end);
            while ($start <= $end) {
                // dd($value, $request->area, $start, $curso->id);
                HorariosNew::create(['id_curso' => $curso->id, 'id_area' => $request->area,
                                    'dia' =>$value, 'hora' => $start, 'status' => 1]);
                // HorariosNew::where('dia', $value)->where('id_area', $request->area)->where('hora', $start)->update([
                //     'id_curso' => $curso->id,
                //     'status' => 1,
                // ]);
                $start += 1;
            }
        }


        return redirect()->route('inicio')->with('cursoCreado', 'Curso creado exitosamente.');
    }

    public function show(Request $request)
    {
        /* Validaciones */
        $rules = ['ciclo' => 'required'];
        $validarDatos = $request->validate($rules);

        /*Consulta para ver que cursos tienen 2 horarios*/
        // $horarios = CursosRequest::obtenerDoblesHorarios();

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
        $cursos = HorariosNew::with('curso', 'area')->whereHas(
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
            $cursos->where('hora', '>=', $request->hora_inicio);
        }

        $cursos = $cursos->orderBy('dia', 'asc')->get();
        // dd($cursos);
        /*Array para meter los cursos sin repetir, habra dos subarrays, uno de dias y otro de horas */
        // 1:38 con coleccion
        // 1:30 sin coleccion
        $horarios = [];

        foreach ($cursos as $value) {
            $idCurso = $value['id_curso'];
            $dia = $value['dia'];
            $cursoExistente = collect($horarios)->firstWhere('id_curso', $idCurso); //Creamos coleccion de horarios y buscamos el idCurso
            
            if ($cursoExistente) {
                $horas = HorariosNew::with('curso', 'area')->where('id_curso', $idCurso)->pluck('hora')->toArray();
                $cursoExistente['dias'][] = $dia; // Agregar el día al arreglo de días sin comprobar duplicados
                // Filtrar las horas correspondientes al día específico
                $horasPorDia = array_filter($horas, function ($hora) use ($dia) {
                    return $hora['dia'] === $dia;
                });
                // Obtener solo los valores de las horas filtradas
                $horasPorDia = array_column($horasPorDia, 'hora');
                // Evitamos datos duplicados
                $cursoExistente['horas'][$dia] = array_unique(array_merge($cursoExistente['horas'][$dia], $horasPorDia));
            } else {
                $horas = HorariosNew::with('curso', 'area')->where('id_curso', $idCurso)->get(['hora', 'dia'])->toArray();
                $dias = HorariosNew::where('id_curso', $idCurso)->pluck('dia')->unique()->toArray(); // Obtener todos los días sin repetir
                // Inicializar un arreglo asociativo vacío para las horas de cada día
                $horasPorDia = [];
                foreach ($dias as $d) {
                    $horasPorDia[$d] = [];
                }
                // Agregar cada hora al día correspondiente
                foreach ($horas as $hora) {
                    $horasPorDia[$hora['dia']][] = $hora['hora'];
                }
                $datosCurso = [
                    'id_curso' => $idCurso,
                    'dias' => $dias, // Guardar los días sin repetir directamente en el subarreglo 'dias'
                    'horas' => $horasPorDia, // Utilizar el arreglo $horasPorDia en lugar de un arreglo simple
                ];
                $horarios[] = $datosCurso;
            }
        }
        // Obtener las relaciones de los cursos en una sola consulta
        $relaciones = HorariosNew::with('curso', 'area')->whereIn('id_curso', array_column($horarios, 'id_curso'))->get();
        // Agregar las relaciones al arreglo de horarios
        //Pasamos por referencia curso, esto para hacerle saber que el valor va a ser modificado directamente
        foreach ($horarios as &$curso) {
            $relacion = $relaciones->firstWhere('id_curso', $curso['id_curso']);
            if ($relacion) {
                $curso['curso'] = $relacion->curso->toArray();
                $curso['area'] = $relacion->area->toArray();
                // unset($curso['relacion']);
            }
        }
        // dd($horarios);
        $url = $request->fullUrl();
        session(['url' => $url]); // Almacenar la URL en la variable de sesión
        $lastCiclo = Cursos::select('ciclo')->where('activo', 1)->orderBy('ciclo', 'desc')->value('ciclo');
        return view('cursos.mostrar', compact('cursos', 'filtros', 'horarios','lastCiclo'));
    }

    public function edit(Cursos $curso)
    {
        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')->distinct()->pluck('departamento');
        /* Valores para select de areas */
        $cursos_area = CursosRequest::getAreas();
        $horarios = HorariosNew::select(
            'id', 'id_curso', 'id_area', 'dia',
            DB::raw("TIME_FORMAT(CONCAT(MIN(hora), ':00'), '%H:%i') AS hora_inicio"),
            DB::raw("TIME_FORMAT(CONCAT(MAX(hora), ':00'), '%H:%i') AS hora_final")
        )
            ->where('id_curso', $curso->id)
            ->groupBy('dia')->get();
        $lastCiclo = Cursos::select('ciclo')->where('activo', 1)->orderBy('ciclo', 'desc')->value('ciclo');
        /*Hacemos un count para ver si tiene un horario en el mismo curso*/
        $validacion_horario = Horarios::where('id_curso', $curso->id)->where('estado', 1)->count();
        return view('cursos.edit', compact('curso', 'cursos_departamento', 'cursos_area', 'validacion_horario', 'horarios', 'lastCiclo'));
    }

    public function update(Request $request, Cursos $curso, HorariosNew $horario)
    {
        /* Validamos los campos del horario */
        $errors = CursosValidacion::validateHoursAndDays($request, 'update');
        if (!empty($errors)) {
            return back()->withInput()->with(['errorsHorario' => $errors]);
        }
        /* Validamos que NRC y nombre sean unicos en el ciclo actual. */
        $vallidationNrcName = CursosValidacion::validateNrc($request, $curso);
        if ($vallidationNrcName !== null)
            return back()->withInput()->with(['cursoMismoCiclo' => $vallidationNrcName]);
        /* Validamos si hay algun curso solapado con otro horario. */
        $cursos = CursosValidacion::validateHorario($request);
        foreach ($cursos[0] as $item)
            if ($item !== null && $item['id_curso'] !== $curso->id)
                return back()->withInput()->with(['cursosExistentes' => $cursos]);

        /* Actualizamos el curso despues de sus validacoines */
        $curso->update($request->all());

        // $horario->where('id_curso', $curso->id)->update(['id_curso' => null, 'status' => 0]);
        foreach ($request->dia as $key => $value) {
            // dd($request->hora_final[$key]);
            $start = (int) $request->hora_inicio[$key];
            /*Validamos que si los minutos son igual a cero que les reste 5 minutos*/
            if (Carbon::parse($request->hora_final[$key])->minute === 0) {
                $newEndTime = Carbon::parse($request->hora_final[$key])->subMinutes(5)->format('H:i');
                // dd($newEndTime);
                $end = (int) $newEndTime;
            } else {
                $end = (int) $request->hora_final[$key];
            }
            // dd($start, $end);
            while ($start <= $end) {
                // dd($value, $request->area, $start, $curso->id);
                // $horario->where('dia', $value)->where('id_area', $request->area)->where('hora', $start)->update([
                //     'id_curso' => $curso->id,
                //     'status' => 1,
                // ]);
                HorariosNew::UpdateOrCreate(['id_curso' => $curso->id, 'id_area' => $request->area,
                                    'dia' =>$value, 'hora' => $start, 'status' => 1]);
                $start += 1;
            }
        }

        return redirect()->back()->with('cursoModificado', 'Curso modificado correctamente.');
    }

    public function destroy($id)
    {
        // dd($id);
        $eliminar = Cursos::findOrFail($id);
        $eliminar->update(['activo' => 0]);

        return back()->with('success', 'Curso eliminado correctamente.');
    }

        public function destroyHorario($id_curso, $dia)
        {
            // dd($horario);
            $horarioNew = new HorariosNew();
            // $eliminar_horario = HorariosNew::findOrFail($id);
            $horarioNew->where('dia', $dia)->where('id_curso', $id_curso)->update(['id_curso' => null, 'status' => 0]);

            return back()->with('success', 'Horario eliminado correctamente');
        }
}