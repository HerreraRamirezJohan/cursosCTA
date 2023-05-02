<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Cursos;
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

        $curso = new Cursos();

        return view('cursos.create', compact(['cursos_departamento', 'curso']));
    }

    public function store(Request $request)
    {
        Cursos::create([
            'nrc' => $request->nrc,              
            'curso_nombre' => $request->nombre,
            'ciclo' => $request->ciclo,
            'observaciones' => $request->observaciones,
            'departamento' => $request->departamento,
            'alumnos_registrados' => $request->alumnos_registrados,
            'nivel' => $request->nivel,
            'profesor' => $request->profesor,
            'codigo' => $request->codigo,
        ]);
        return redirect()->route('inicio');
        // return redirect('inicio')->with('msg', 'Empleado agregado exitosamente.');


        // $curso = new Cursos();
        // dd($curso);
        // $curso->fill($request->all());
        // if ($curso->save()) {
        //     return redirect()->route('cursos.index')->with('msg', 'Curso agregado exitosamente');
        // } else {
        //     return redirect()->route('cursos.create');
        // }
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
            })
            ->paginate(15);

        // ->get();
        // ->toSql();



        // return $cursos;
        // return view('cursos.mostrar', compact('cursos')); 
        return view('cursos.mostrar', compact('cursos', 'filtros'));
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
