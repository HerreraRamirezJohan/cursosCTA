<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\HorariosNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CursosFunctions\CursosRequest;


class AreasController extends Controller
{
    public function index()
    {
        $areas = Areas::select('areas.area', DB::raw('COUNT(horarios_news.id_area) as disponibilidad'))
            ->leftJoin('horarios_news', 'areas.id', '=', 'horarios_news.id_area')
            ->where(function ($query) {
                $query->where('areas.tipo_espacio', 'Laboratorio')
                    ->orWhere('areas.tipo_espacio', 'Aula');
            })->where('areas.sede', 'Belenes')
            ->where('areas.activo', 1)
            ->where('horarios_news.status', 0)
            ->groupBy('areas.area')
            ->get();

        // dd(!isset($areas));
        // $areasTotales = Areas::select('area')->where(function ($query) {
        //     $query->where('tipo_espacio', 'Laboratorio')
        //         ->orWhere('tipo_espacio', 'Aula');
        // })->where('sede', 'Belenes')->where('activo', 1)->get();
        // dd($areaTotales);

        return view('areas.index', compact('areas'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //x|
    }

    public function show(Request $request)
    {

        $diaRequest = $request->dia;
        $horaRequest = $request->hora . ':00';

        // Obtener la hora en formato de 12 horas con minutos y AM/PM
        // $horaFormateada = ($horaRequest < 12) ? $horaRequest . ':00 AM' : (($horaRequest == 12) ? '12:00 PM' : ($horaRequest - 12) . ':00 PM');


        $horariosDisponibles = HorariosNew::select('id_area', 'dia', 'hora', 'status')
            ->where('dia', $request->dia)
            ->where('hora', $request->hora)
            ->groupBy('id_area', 'dia', 'hora')
            ->get();

        // $areasHoras = [];
        // $idAreaDelete = [];
        // foreach ($horariosDisponibles as $horario) {

        //     $idArea = $horario->id_area;
        //     $area = $horario->area->area;
        //     $dia = $horario->dia;
        //     $hora = $horario->hora;

        //     //Guardamos los id_area de todos las areas que no tiene disponiblidad
        //     if ($horario->status == 1 && $hora == $request->hora) {
        //         $idAreaDelete[] = ['id_area' => $idArea];
        //         continue;
        //     }


        //     if (!isset($areasHoras[$idArea])) {
        //         $areasHoras[$idArea] = [
        //             'id_area' => $idArea,
        //             'area' => $area,
        //             'dia' => $dia,
        //             'horas' => '' // Variable para almacenar las horas concatenadas
        //         ];
        //     }

        //     $areasHoras[$idArea]['horas'] .= intval($hora) . '-' . (intval($hora) < 21 ? (intval($hora) + 1) : '') . ', ';
            
            
        // }

        // // Eliminar la última coma y espacio de cada cadena de horas
        // foreach ($areasHoras as &$area) {
        //     $area['horas'] = rtrim($area['horas'], ', ');

        //     $lastChars = substr($area['horas'], -5);
        //     if ($lastChars === ', 21-') {
        //         $area['horas'] = substr($area['horas'], 0, -5);
        //     }
        // }
        // unset($area);
        // // dd($idAreaDelete, $areasHoras);
        // foreach ($idAreaDelete as $key => $value) {
        //     foreach ($areasHoras as $id => $value2) {
        //         if ($idAreaDelete[$key]['id_area'] == $id) {
        //             unset($areasHoras[$id]);
        //         }
        //     }
        // }


        return view('areas.show', compact('horariosDisponibles', 'diaRequest', 'horaRequest'));
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