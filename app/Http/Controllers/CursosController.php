<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Cursos;
use App\Models\Horarios;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\CursosValidacion;

class CursosController extends Controller
{
    public function index()
    {

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')
            ->distinct()->pluck('departamento');

        $cursos_ciclo = Cursos::select('ciclo')->orderBy('ciclo', 'desc')
            ->distinct()->pluck('ciclo');


        // $cursos_sede = Areas::select('sede')->orderBy('sede', 'asc')
        //     ->distinct()->pluck('sede');

        $cursos_area = Areas::select('id', 'sede', 'edificio', 'area')
            ->Where(function ($query) {
                $query->whereIn('sede', ['La Normal', 'Belenes']);
            })
            ->Where(function ($query) {
                $query->whereIn('tipo_espacio', ['Laboratorio', 'Aula']);
            })->distinct()->orderBy('sede')->orderBy('edificio')->orderBy('area')
            ->get();

        /*Imprimir los horarios (loop hecho antes de tener hora inicio y final)*/
        // $horarios = [];
        // for ($i = 7; $i <= 20; $i++) {
        //     $horarios[] = str_pad($i, 2, '0', STR_PAD_LEFT) . '00-' . str_pad($i + 1, 2, '0', STR_PAD_LEFT) . '00';
        // }

        return view('cursos.index', compact(['cursos_departamento', 'cursos_ciclo', 'cursos_area']));
    }

    public function create()
    {
        /*Consulta para ver que cursos tienen 2 horarios*/
        $horarios = Horarios::whereIn('id_curso', function ($query) {
            $query->select('id_curso')
                ->from('horarios')
                ->groupBy('id_curso')
                ->havingRaw('COUNT(id_curso) = 2');
        })->get()->toArray();

        $cursos_departamento = Cursos::select('departamento')->orderBy('departamento', 'asc')
            ->distinct()->pluck('departamento');

        $cursos_ciclo = Cursos::select('ciclo')->orderBy('ciclo', 'desc')->value('ciclo');

        $cursos_area = Areas::select('id', 'sede', 'edificio', 'area')
            ->Where(function ($query) {
                $query->whereIn('sede', ['La Normal', 'Belenes']);
            })
            ->Where(function ($query) {
                $query->whereIn('tipo_espacio', ['Laboratorio', 'Aula']);
            })->distinct()->orderBy('sede')->orderBy('edificio')->orderBy('area')
            ->get();

        // ->toSql();

        // return $cursos_area;

        $curso = new Cursos();

        return view('cursos.create', compact('cursos_departamento', 'curso', 'cursos_area', 'cursos_ciclo', 'horarios'));
    }

    public function store(Request $request)
    {
        /* Validamos los campos del horario */
        $errors = CursosValidacion::validateHoursAndDays($request);
        if (!empty($errors)) {
            return back()->withInput()->with(['errorsHorario' => $errors]);
        }
        /* Validamos si hay algun curso solapado con otro horario. */
        $cursos = CursosValidacion::validateHorario($request);
        foreach ($cursos as $curso)
            if ($curso !== null)
                return redirect()->back()->withInput()->with(['cursosExistentes' => $cursos]);
        // return response()->json($cursos);
        /*Si no existe nigun curso entre esas horas y en la area, se crea el curso*/
        if (!($request->hora_final[0] > $request->hora_inicio[0])) {
            return redirect()->route('inicio')->with('primerHorario', 'La hora de inicio no puede ser mayor que la hora final.');
        }
        /*Validamos que el nrc debe de tener de 7 a 10 caracteres*/
        if (strlen($request->get('nrc')) < 6 || strlen($request->get('nrc')) > 10) {
            return back()->withInput()->with('nrcLength', 'El nrc debe tener de 6 a 10 digitos');
        }
        /*Se hace una validacion doble, primero que el cupo no tenga mas dos digitos y que el cupo no sea mayor a 60 */elseif (strlen($request->get('cupo')) > 2 || $request->cupo > 60) {
            return back()->withInput()->with('cupoMax', 'El cupo no puede ser mayor a 60');
        }
        /*Se hace una validacion doble, primero que el cupo no tenga mas dos digitos y que alumnos R. no sea mayor a 60 */elseif (strlen($request->get('alumnos_registrados')) > 2 || $request->alumnos_registrados > 60) {
            return back()->withInput()->with('alumnosMax', 'El número de alumnos registrados no debe ser mayor a 60');
        }
        /*Validamos que los alumnos registrados no puedan ser mayor al cupo del curso*/elseif ($request->alumnos_registrados > $request->cupo) {
            return back()->withInput()->with('alumnosMayor', 'El número de alumnos registrados sobrepasa el cupo del curso');
        }
        /*Valida que el codigo de profesor debe ser de 8 digitos*/elseif (strlen($request->get('codigo')) != 8) {
            return back()->withInput()->with('codigoLength', 'El código de profesor deber tener 8 digitos');
        } else {
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
        }
        if (!($request->hora_inicio[1] < $request->hora_final[1]) && $request->hora_inicio[1] !== null) {
            // dd($request->hora_inicio[1]);
            return redirect()->route('inicio')->with('segundoHorario', 'Error en el segundo horario.');
        } else {
            if ($request->filled(['hora_inicio.1', 'hora_final.1', 'dia.1'])) {
                if ($request->dia[0] != $request->dia[1]) {
                    $curso->horarios()->create([
                        'id_curso' => $curso->id,
                        'dia' => $request->dia[1],
                        'hora_inicio' => $request->hora_inicio[1],
                        'hora_final' => $request->hora_final[1],
                        'id_area' => $request->area,
                    ]);
                } else
                    return back()->withErrors(['alert' => '¡El curso no puede tener dos horarios iguales!']);
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

        // return $cursos->toSql();
        // $total = $cursos->distinct('id_curso')->count();
        // $cursos = $cursos->distinct('id_curso')->paginate(15);
        $cursos = $cursos->groupBy('id_curso')->paginate(15);

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
                ->havingRaw('COUNT(id_curso) = 2');
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

        /* Solicitamos los horarios que tenga el curso */
        $horariosDelCurso = Horarios::select('horarios.*')
            ->where('id_curso', $curso->id)
            ->get();



        /*Hacemos un count para ver si tiene un horario en el mismo curso*/
        $validacion_horario = Horarios::where('id_curso', $curso->id)->count();
        //dd($validacion_horario);

        return view('cursos.edit', compact('curso', 'cursos_departamento', 'cursos_area', 'horariosDelCurso', 'validacion_horario', 'horarios'));
    }

    public function update(Request $request, Cursos $curso, Horarios $horario)
    {
        /* Validamos los campos del horario */
        $errors = CursosValidacion::validateHoursAndDays($request);
        if (!empty($errors)) {
            return back()->with(['errorsHorario' => $errors]);
        }

        /* Validamos si hay algun curso solapado con otro horario. */
        $cursosSolapados = CursosValidacion::validateHorario($request);
        foreach ($cursosSolapados as $item) {
            if ($item !== null && $item->id_curso !== $curso->id)
                return redirect()->back()->withInput()->with(['cursosExistentes' => $cursosSolapados]);
        }
        // dd(strlen($request->get('nrc')));

        if ($request->alumnos_registrados > $request->cupo) {
            return back()->withInput()->with('alumnosMayor', 'El número de alumnos registrados sobrepasa el cupo del curso');
        } elseif (strlen($request->get('nrc')) < 6 || strlen($request->get('nrc')) > 10) {
            return back()->withInput()->with('nrcLength', 'El nrc debe tener de 6 a 10 digitos');
        } elseif (strlen($request->input('codigo')) != 8) {
            return back()->withInput()->with('codigoLength', 'El código debe tener 8 digitos');
        }
        // elseif ($length <= 8){
        //     return back()->withInput()->with('nrcLength', 'El nrc debe tener minimo 7 digitos');
        // }
        else {
            $curso->update($request->all());
        }

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
            /*Se valida hora inicio y hora final del primer horario*/
            if (!($request->hora_final[0] > $request->hora_inicio[0])) {
                return redirect()->route('inicio')->with('primerHorario', 'La hora de inicio no puede ser mayor que la hora final del dia' . $request->dia[0]);
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
            }
            /*Validamos si el usuario creo un segundo horario en editar*/
            if ($request->filled(['hora_inicio.1', 'hora_final.1', 'dia.1'])) {
                /*Se valida hora inicio y hora final del segundo horario*/
                if (!($request->hora_inicio[1] < $request->hora_final[1]) && $request->hora_inicio[1] !== null) {
                    return redirect()->route('inicio')->with('segundoHorario', 'Error en el segundo horario.');
                } else {
                    Horarios::create([
                        'id_curso' => $curso->id,
                        'dia' => $request->dia[1],
                        'hora_inicio' => $request->hora_inicio[1],
                        'hora_final' => $request->hora_final[1],
                        'id_area' => $request->area,

                    ]);
                }
            }
        }

        // return redirect()->route('inicio')->with('cursoModificado', 'Curso modificado correctamente.');
        // dd($request->filter_url);
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
        $eliminar_horario->update(['activo' => 0]);

        return back()->with('success', 'Horario eliminado correctamente');
    }


}