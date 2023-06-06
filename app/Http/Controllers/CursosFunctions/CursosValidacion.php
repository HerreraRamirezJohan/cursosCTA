<?php

namespace App\Http\Controllers\CursosFunctions;

use App\Models\Horarios;
use App\Models\Cursos;

use DateTime;
use Exception;

use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\returnSelf;

class CursosValidacion {
    public static function validateHoursAndDays($request, $action = null){
        $errors = [];
        self::validateFilledInputs($request, $action);
        /* Validar el input del ciclo. */
        $validacionCiclo = self::validarCiclo($request->ciclo);
        if ($validacionCiclo !== null) {
            $errors['ciclo'] = $validacionCiclo;
        }
        /* Validamos que NRC y nombre sean unicos en el ciclo actual. */
        // $vallidationNrcName = self::validateNrc($request);
        // if($vallidationNrcName !== null)
        //     $errors['uniqueNrc'] = $vallidationNrcName;

        /*Validamos que los alumnos registrados no puedan ser mayor al cupo del curso*/
        if ($request->alumnos_registrados > $request->cupo) {
            $errors['alumnosMayor'] = 'El número de alumnos registrados sobrepasa el cupo del curso';
        }
        /* Si exiuste un segundo horario, validamos que no coloque 2 horarios en el mismo dia. */
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
            /* Validamos el rango de horario que puede registrar un curso */
            if( ($hora_inicio >= new \DateTime('07:00') && $hora_inicio <= new \DateTime('20:00')) &&
                ($hora_final >= new \DateTime('07:55') && $hora_final <= new \DateTime('21:00'))){
                    /* Validamos que no ingrese una hora inicio mayor a la final. */
                    if($hora_inicio > $hora_final)
                        $errors[] = "¡Has ingresado una hora de inicio mayor a la hora final en el horario del ".$dia."!";
                    else
                        if($minutosTotales < 55)/* Validar la duracion del curso */
                            $errors[] = "¡El horario del ".$dia." debe tener una duración minima de 55 minutos!";
            }else{
                    $errors[] = "El rango para registrar un horario debe ser de 07:00 a.m. - 09:00 p.m.";
            }
        }
        return $errors;
    }

    public static function validateHorario($request, $action = null)
    {
        self::validateFilledInputs($request, $action);

        /* Obtenemos el curso que interfiere con el horario 1*/
        $existingCourse1 = Horarios::with(['curso' => function ($query) {
            $query->where('activo', true);
            }, 'area'])
            ->where('id_area', $request->area)
            ->where('dia', $request->dia[0])
            ->where('estado', 1)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio[0], $request->hora_final[0]]);
                $query->orWhereBetween('hora_final', [$request->hora_inicio[0], $request->hora_final[0]]);
            })
            ->first();
        // dd($existingCourse1);
        /* Validamos el 2do horario en caso que lo haya */
        $existingCourse2 = null;
        if (count($request->dia) > 1) {
            $existingCourse2 = Horarios::with(['curso' => function ($query) {
                $query->where('activo', true);
                }, 'area'])
                ->where('id_area', $request->area)
                ->where('dia', $request->dia[1])
                ->where('estado', 1)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('hora_inicio', [$request->hora_inicio[1], $request->hora_final[1]]);
                    $query->orWhereBetween('hora_final', [$request->hora_inicio[1], $request->hora_final[1]]);
                })
                ->first();
        }
        // dd($existingCourse2);
        /*Hacemos una condicion de que si hay un curso existente en la misma area y entre esas horas
            las introducimos en un array para mandar el mensaje de error*/
        $cursos = [];
        array_push($cursos, $existingCourse1 ?  $existingCourse1 : null);
        array_push($cursos, $existingCourse2 ?  $existingCourse2 : null);
        // dd($cursos);

        return $cursos;
    }

    private static function validateFilledInputs($request, $action){
        $validationRules = [
            'curso_nombre' => 'required',
            'nrc' => 'required|string|between:5,10',
            'ciclo' => 'required',
            'area' => 'required',
            'departamento' => 'required',
            'alumnos_registrados' => 'required|numeric|between:0,60',
            'cupo' => 'required|numeric|between:1,60',
            'nivel' => 'required',
            'profesor' => 'required',
            'codigo' => 'required|between:8,8',
            'dia.0' => 'required',
            'hora_inicio.0' => 'required',
            'hora_final.0' => 'required',
        ];    
        $customMessages = [
            'curso_nombre.required' => 'El nombre del curso es obligatorio',
            'nrc.required' => 'El :attribute es obligatorio',
            'nrc.between' => 'El :attribute debe tener de :min a :max caracteres',
            'ciclo.required' => 'El :attribute es obligatorio',
            'area.required' => 'El :attribute es obligatorio',
            'departamento.required' => 'El :attribute es obligatorio',
            'alumnos_registrados.required' => 'El campo :attribute es obligatorio',
            'alumnos_registrados.between' => 'Los :attribute debe ser entre 1 al limite de cupos regitrado',
            'cupo.between' => 'El :attribute debe ser entre 1 a 60.',
            'cupo.required' => 'El campo :attribute es obligatorio',
            'nivel.required' => 'El :attribute es obligatorio',
            'profesor.required' => 'El nombre del :attribute es obligatorio',
            'codigo.required' => 'El :attribute es obligatorio',
            'codigo.between' => 'El :attribute debe ser de 8 caracteres.',
            'dia.0.required' => 'El dia es obligatorio',
            'hora_inicio.0.required' => 'La hora de inicio es obligatorio',
            'hora_final.0.required' => 'La hora final es obligatorio',
        ];
        $request->validate($validationRules, $customMessages);
    }

    private static function validarCiclo($ciclo){
        $year = intval(substr($ciclo, 0, 4));//obtenemos el año
        if(!$year)
            return 'Formato de ciclo registrado invalido debe ser YYYY[A-B]';  
        $letra = substr($ciclo, 4, 1);//obtenemos la letra
        $ciclo_actual = Cursos::select('ciclo')->where('activo', 1)->orderBy('ciclo', 'desc')->value('ciclo');
        $year_actual = intval(substr($ciclo_actual, 0, 4));//obtenemos el año
        $letra_actual = substr($ciclo_actual, 4, 1);//obtenemos la letra

        if(strcmp(self::getCiclo(), $ciclo) !== 0){
            if($letra === 'A' || $letra === 'B'){
                if($letra_actual === 'A'){
                    if($year_actual !== $year)
                        return 'El ciclo siguiente debe ser: ' . $year_actual . 'B';
                    if($letra === $letra_actual)
                        return 'El ciclo debe ser B';
                }elseif($letra_actual === 'B'){
                    if($year !== $year_actual+1)
                        return 'El ciclo siguiente debe ser: '. (string)($year_actual+1) . 'A';
                    if($letra === $letra_actual)
                        return 'El ciclo debe ser A';
                }
            }else
                return 'El ciclo ingresado es invalido, debe ser un año vigente y tener el ciclo A o B correspondiente';
        }

        return null;
    }

    public static function getCiclo(){
        $cursos_ciclo = Cursos::select('ciclo')->where('activo', 1)->orderBy('ciclo', 'desc')->value('ciclo');
        /*Consulta para ver la diferencia de tiempos desde el ultimno curso creado*/
        $primerCursoDelCiclo = Cursos::where('ciclo', $cursos_ciclo)->where('created_at', '!=', null)->orderBy('created_at', 'asc')->first();
        $primerCursoDelCiclo = $primerCursoDelCiclo->created_at;
        $tiempoTranscurrido = $primerCursoDelCiclo->diff()->m;

        /* Si ya pasaron 4 meses del primer curso del ciclo actual manda null
        lo que permitira poder ingresar un ciclo manualmente
        en caso contrario mando el ciclo actual que se cursa */
        return $tiempoTranscurrido < 4 ? $cursos_ciclo : null;
    }

    public static function validateNrc($request){
        /* validamos si el curso ya existe */
        $curso = Cursos::select('cursos.*')
        ->where('nrc', $request->nrc)
        ->orWhere('curso_nombre', $request->curso_nombre)
        ->latest()//Obtenemos el ultimo registrado en la DB
        ->first();

        // dd($curso, isset($curso));
        
        /* No existe ningun curso que coincida */
        if(isset($curso) == null)
            return null;

        //Obtenemos el ciclo actual
        $ciclo_actual = Cursos::select('ciclo')->where('activo', 1)->orderBy('ciclo', 'desc')->value('ciclo');
        // dd(strcmp($request->ciclo, $ciclo_actual));
        if(!strcmp($request->ciclo, $ciclo_actual))
            return ['Ya existe un curso con el nombre o NRC registrado en el ciclo actual ', $curso, 'Favor de ingresar valores únicos.'];
        
        if(strcmp($request->curso_nombre, $curso->curso_nombre) != 0 || strcmp($request->nrc, $curso->nrc) != 0)
            return ['El nombre o NRC no coincide con el siguiente curso: ', $curso, 'Se requiere que el nombre y el NRC coincida con el curso para agregarlo al nuevo ciclo.'];
        return null;
    }
}