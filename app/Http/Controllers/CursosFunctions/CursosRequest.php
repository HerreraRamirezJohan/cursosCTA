<?php

namespace App\Http\Controllers\CursosFunctions;
use App\Models\Horarios;
use App\Models\Areas;

class CursosRequest{


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

    

    // public static function generarHorarios($request)
    // {
    //     foreach ($ as $key => $value) {
    //         # code...
    //     }
    // }


}