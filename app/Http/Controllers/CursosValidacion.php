<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use DateTime;

class CursosValidacion {
    public static function validateHoursAndDays($request){
        $errors = [];

        if(isset($request->dia[1]))
            if($request->dia[0] === $request->dia[1])
                $errors[] = "¡No puedes tener 2 horarios en el mismo día!";

        /* Iteramos en cada horario para verificar si no hay error en lo datos 
        esto validara n cantidad de horarios que tenga el curso. */
        foreach ($request->dia as $key => $value){
            /* Obtenemos los datos de manera legible y con un tipo de dato que podamos trabajar*/
            $dia = $request->dia[$key];
            $hora_inicio = new DateTime($request->hora_inicio[$key]);
            $hora_final = new DateTime($request->hora_final[$key]);
            $duracion =  $hora_inicio->diff($hora_final);
            $minutosTotales = ($duracion->h * 60) + $duracion->i;
            /* Validamos  */
            if( ($hora_inicio >= new \DateTime('07:00') && $hora_inicio <= new \DateTime('20:00')) &&
                ($hora_final >= new \DateTime('07:55') && $hora_final <= new \DateTime('21:00'))){
                    /* Validamos que no ingrese una hora inicio mayor a la final. */
                    if($hora_inicio > $hora_final)
                        $errors[] = "¡Has ingresado una hora de inicio mayor a la hora final en el horario del ".$dia."!";
                    else
                        if($minutosTotales < 55)/* Validar la duracion del curso */
                            $errors[] = "¡El horario del ".$dia." debe tener una duración minima de 55 minutos!";
            }else{
                    $errors[] = "¡El rango para registrar un horario debe ser de 07:00 a.m. - 09:00 p.m.";
            }
        }
        return $errors;
    }

    public static function validateHorario($request)
    {
        $validationRules = [
            'curso_nombre' => 'required',
            'nrc' => 'required',
            'ciclo' => 'required',
            'area' => 'required',
            'departamento' => 'required',
            'alumnos_registrados' => 'required|numeric|max:60',
            'cupo' => 'required|numeric|max:60',
            'nivel' => 'required',
            'profesor' => 'required',
            'codigo' => 'required',
            'dia.0' => 'required',
            'hora_inicio.0' => 'required',
            'hora_final.0' => 'required',
        ];
        $customMessages = [
            'curso_nombre.required' => 'El nombre del curso es obligatorio',
            'nrc.required' => 'El :attribute es obligatorio',
            'ciclo.required' => 'El :attribute es obligatorio',
            'area.required' => 'El :attribute es obligatorio',
            'departamento.required' => 'El :attribute es obligatorio',
            'alumnos_registrados.required' => 'El campo :attribute es obligatorio',
            'alumnos_registrados.max' => 'El maximo de alumnos registrados puede ser 60',
            'cupo.max' => 'El cupo maximo de un curso es 60',
            'cupo.required' => 'El campo :attribute es obligatorio',
            'nivel.required' => 'El :attribute es obligatorio',
            'profesor.required' => 'El nombre del :attribute es obligatorio',
            'codigo.required' => 'El :attribute es obligatorio',
            'dia.0.required' => 'El dia es obligatorio',
            'hora_inicio.0.required' => 'La hora de inicio es obligatorio',
            'hora_final.0.required' => 'La hora final es obligatorio',
        ];

        $request->validate($validationRules, $customMessages);

        /* Obtenemos el curso que interfiere con el horario 1*/
        $existingCourse1 = Horarios::with(['curso' => function ($query) {
                $query->where('activo', true);
                }, 'area'])
            ->where('id_area', $request->area)
            ->where('dia', $request->dia[0])
            ->where(function ($query) use ($request) {
                $query->where([
                    ['hora_inicio', '<=',  $request->hora_inicio[0]],
                    ['hora_final', '>=',  $request->hora_inicio[0]],
                ])->orWhere(function ($query) use ($request) {
                    $query->where([
                        ['hora_inicio', '<=',  $request->hora_final[0]],
                        ['hora_final', '>=', $request->hora_final[0]],
                    ]);
                });
            })
            ->first();
        // dd($existingCourse1);
        /* Validamos el 2do horario en caso que lo haya */
        $existingCourse2 = null;
        if (count($request->dia) > 1) {
            $existingCourse2 = Horarios::with('curso', 'area')
                ->where('id_area', $request->area)
                ->where('dia', $request->dia[1])
                ->where(function ($query) use ($request) {
                    $query->where([
                        ['hora_inicio', '<=',  $request->hora_inicio[1]],
                        ['hora_final', '>=',  $request->hora_inicio[1]],
                    ])->orWhere(function ($query) use ($request) {
                        $query->where([
                            ['hora_inicio', '<=',  $request->hora_final[1]],
                            ['hora_final', '>=', $request->hora_final[1]],
                        ]);
                    });
                })
                ->first();
        }
        // dd($existingCourse2);
        /*Hacemos una condicion de que si hay un curso existente en la misma area y entre esas horas
            las introducimos en un array para mandar el mensaje de error*/
        $cursos = [];
        array_push($cursos, $existingCourse1 ?  $existingCourse1 : null);
        array_push($cursos, $existingCourse2 ?  $existingCourse2 : null);
        //dd($cursos);

        return $cursos;
    }
}