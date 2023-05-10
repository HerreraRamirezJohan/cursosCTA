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

        $cursos_ciclo = Cursos::select('ciclo')->orderBy('ciclo', 'desc')->value('ciclo');

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


        // ->toSql();

        // return $cursos_area;

        $curso = new Cursos();

        return view('cursos.create', compact('cursos_departamento', 'curso', 'cursos_area', 'cursos_ciclo'));
    }

    /* Metodo que devuelve un mensaje con la validacion del formulario cursos con JS*/

    public function store(Request $request)
    {
        /* Obtenemos el curso que interfiere */
        $existingCourse = Horarios::with('curso', 'area')
            ->where('id_area', $request->area)
            ->where('dia', $request->dia)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio[0], $request->hora_final[0]]);
                // ->orWhereBetween('hora_final', ['09:00:00', '12:00:00']);
            })
            ->first();
        // dd($existingCourse);

        /*Hacemos una condicion de que si hay un curso existente en la misma area y entre esas horas*/
        if ($existingCourse){
            // devuelve un error diciendo que ya hay un curso en el horario y área especificados
            // Error 422 para que el servidor entienda la peticion pero no la procese
            return response()->json(['message' => 'Ya hay un curso en este horario y área'], 422);
        
        }
        /*Si no existe nigun curso entre esas horas y en la area, se crea el curso*/
        else{
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
                ]);
            }
            return "No existe un curso similar, por lo que el curso se ha creado con exito.";

            // return response()->json(['curso' => $curso], 200);
        }


        // return redirect()->route('inicio');


    }

    public function show(Request $request)
    {
        /* Validaciones */
        $rules = ['ciclo' => 'required'];
        $validarDatos = $request->validate($rules);

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
            ['column' => 'ciclo', 'value' => request('ciclo')],
            ['column' => 'departamento', 'value' => request('departamento')],
            ['column' => 'dia', 'value' => request('dia')],
        ];

        $cursos = Horarios::with('curso', 'area');

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


        $cursos = $cursos->paginate(15);
        return view('cursos.mostrar', compact('cursos', 'filtros'));
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

        return view('cursos.edit', compact('curso', 'cursos_departamento', 'cursos_area', 'horariosDelCurso'));
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
