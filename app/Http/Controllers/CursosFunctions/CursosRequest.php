<?php

namespace App\Http\Controllers\CursosFunctions;
use App\Models\Horarios;
use App\Models\Areas;

class CursosRequest{
    public static function obtenerDoblesHorarios(){
        $horarios = Horarios::whereIn('id_curso', function ($query) {
            $query
                ->select('id_curso')
                ->from('horarios')
                ->groupBy('id_curso')
                ->havingRaw('COUNT(id_curso) >= 2');
        })
        ->where('estado', 1)
        ->get();

        return $horarios;
    }

    public static function getAreas(){
        $cursos_area = Areas::select('id', 'sede', 'edificio', 'area')
            ->where(function ($query) {
                $query->whereIn('sede', ['La Normal', 'Belenes']);
            })
            ->where(function ($query) {
                $query->whereIn('tipo_espacio', ['Laboratorio', 'Aula']);
            })->where('activo', 1)
            ->distinct()->orderBy('sede')->orderBy('edificio')->orderBy('area')
            ->get();

        return $cursos_area;
    }


}