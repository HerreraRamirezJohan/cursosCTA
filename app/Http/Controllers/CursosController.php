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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
    {
        $rules = ['ciclo' => 'required'];
        $validarDatos = $request->validate($rules);


        $nombre = $request->get('curso_nombre');
        $departamento = $request->get('departamento');
        $sede = $request->get('sede');
        $ciclo = $request->get('ciclo');
        $dia = $request->get('dia');
        $horario = $request->get('horario');


        $cursos = Cursos::select('cursos.*', 'areas.*', 'horarios.*')
            ->join('horarios', 'cursos.id', '=', 'horarios.id_curso')
            ->join('areas', 'horarios.id_area', '=', 'areas.id')
            ->when($nombre, function ($query, $nombre) {
                return $query->where('curso_nombre', 'LIKE', "%".$nombre."%");
            })
            ->when($departamento, function ($query, $departamento) {
                return $query->where('departamento', $departamento);
            })
            ->when($sede, function ($query, $sede) {
                return $query->where('sede', $sede);
            })
            ->when($ciclo, function ($query, $ciclo) {
                return $query->where('ciclo', $ciclo);
            })
            ->when($dia, function ($query, $dia) {
                return $query->where('dia', $dia);
            })
            ->when($horario, function ($query, $horario) {
                return $query->where('horario', $horario);
            })
            // ->toSql();
            ->get();



        // return $cursos;
        return view('cursos.mostrar', compact('cursos'));
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
