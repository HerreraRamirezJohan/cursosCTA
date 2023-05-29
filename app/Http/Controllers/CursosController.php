<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Cursos;
use App\Models\Horarios;
use DateTime;
use Illuminate\Http\Request;

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
        if(!empty($errors)){
            return back()->withInput()->with(['errorsHorario' => $errors]);
        }
        /* Validamos si hay algun curso solapado con otro horario. */
        $cursos = CursosValidacion::validateHorario($request);
        foreach ($cursos as $curso)
            if ($curso !== null)
                return redirect()->back()->withInput()->with(['cursosExistentes' => $cursos]);

        /* Crea el curso */
        $curso = Cursos::create([
            'nrc'                   => $request->nrc,
            'curso_nombre'          => $request->curso_nombre,
            'ciclo'                 => $request->ciclo,
            'observaciones'         => $request->observaciones,
            'departamento'          => $request->departamento,
            'alumnos_registrados'   => $request->alumnos_registrados,
            'cupo'                  => $request->cupo,
            'nivel'                 => $request->nivel,
            'profesor'              => $request->profesor,
            'codigo'                => $request->codigo,
        ]);
        /* Crea el primer horario */
        $curso->horarios()->create([
            'dia' => $request->dia[0],
            'hora_inicio' => $request->hora_inicio[0],
            'hora_final' => $request->hora_final[0],
            'id_area' => $request->area,
        ]);
        /* Si existe un 2do horario crealo. La validacion se hace arriba con la funcion */
        if ($request->filled(['hora_inicio.1', 'hora_final.1', 'dia.1'])) {
            $curso->horarios()->create([
                'id_curso'  => $curso->id,
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

        // dd($cursos);
        // return $total;
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
        //dd($validacion_horario);

        return view('cursos.edit', compact('curso', 'cursos_departamento', 'cursos_area', 'horariosDelCurso', 'validacion_horario'));
    }

    public function update(Request $request, Cursos $curso, Horarios $horario)
    {
        /* Validamos los campos del horario */
        $errors = CursosValidacion::validateHoursAndDays($request);
        if(!empty($errors)){
            return back()->with(['errorsHorario' => $errors]);
        }

        /* Validamos si hay algun curso solapado con otro horario. */
        $cursosSolapados = CursosValidacion::validateHorario($request);
        foreach ($cursosSolapados as $item) {
            if ($item !== null && $item->id_curso !== $curso->id)
                return redirect()->back()->withInput()->with(['cursosExistentes' => $cursosSolapados]);
        }

        /* Actualizamos los datos del curso que no influyen en el horario */
        $curso->update($request->all());

        if (count($request->horariosId) > 1) {/* Si el curso cuenta con mas de 1 horario realizamos un loop para realizar sus actualizaciones */
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
        } else {/* En el caso que solo haya 1 horario validamos si se registro uno nuevo */
            /* Actualizamos el primero*/
            $horario->where('id', $request->horariosId[0])
            ->update(
                [
                    'dia' => $request->dia[0],
                    'hora_inicio' => $request->hora_inicio[0],
                    'hora_final' => $request->hora_final[0]
                    ]
                );
            /* Creo un segundo horario en editar*/ 
            if ($request->filled(['hora_inicio.1', 'hora_final.1', 'dia.1'])) {
                Horarios::create([
                    'id_curso'  => $curso->id,
                    'dia' => $request->dia[1],
                    'hora_inicio' => $request->hora_inicio[1],
                    'hora_final' => $request->hora_final[1],
                    'id_area' => $request->area,
                    
                ]);
            }
        }

        return redirect()->away($request->filter_url)->with('cursoModificado', 'Curso modificado correctamente.');

        
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
        // dd($id);
        $eliminar = Horarios::findOrFail($id);
        $eliminar->destr(['activo' => 0]);

        return back()->with('success', 'Registro eliminado correctamente');
    }

}
