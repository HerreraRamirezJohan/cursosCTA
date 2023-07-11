<?php

namespace App\Http\Controllers\CursosFunctions;

use App\Models\Horarios;
use App\Models\Cursos;

use App\Models\HorariosNew;
use DateTime;
use Exception;

use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\returnSelf;

class CursosValidacion {
    public static function validateCicloExcel($request, $action = null){
        $errors = [];
        /* Validar el input del ciclo. */
        if($action != 'update'){
            $validacionCiclo = self::validarCiclo($request->ciclo);
            if ($validacionCiclo !== null) {
                $errors['ciclo'] = $validacionCiclo;
            }
        }
        return $errors;
  
    }

    public static function validateHoursAndDays($request, $action = null){
        $errors = [];
        self::validateFilledInputs($request, $action);
        /* Validar el input del ciclo. */
        if($action != 'update'){
            $validacionCiclo = self::validarCiclo($request->ciclo);
            if ($validacionCiclo !== null) {
                $errors['ciclo'] = $validacionCiclo;
            }
        }
        /* Validamos que NRC y nombre sean unicos en el ciclo actual. */
        $vallidationNrcName = self::validateNrc($request);
        if($vallidationNrcName !== null)
            $errors['uniqueNrc'] = $vallidationNrcName;

        /*Validamos que los alumnos registrados no puedan ser mayor al cupo del curso*/
        if ($request->alumnos_registrados > $request->cupo) {
            $errors['alumnosMayor'] = 'El número de alumnos registrados sobrepasa el cupo del curso';
        }
        /* Si existe un segundo horario, validamos que no coloque 2 horarios en el mismo dia. */
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
                            $errors[] = "¡El horario del ".$dia." debe tener una duración mínima de 55 minutos!";
            }else{
                    $errors[] = "El rango para registrar un horario debe ser de 07:00 a.m. - 09:00 p.m.";
            }
        }
        return $errors;
    }

    public static function validateHorario($request, $action = null)
    {

        $horasOcupadas = [];
        $nrcs = [];
        
        self::validateFilledInputs($request, $action);
        foreach ($request->dia as $key => $value) {
            $start = (int) $request->hora_inicio[$key];
            $end = (int) $request->hora_final[$key];
            // dd($start == $end);
            // dd($start, $end);
            while ($start <= $end) {
                // dd($value, $request->area, $start, $curso->id);
                $horaOcupada = HorariosNew::with('curso', 'area')
                ->where('id_area', $request->area)->where('dia', $request->dia[$key])->where('hora', $start)->first();
            
                if (isset($horaOcupada->curso->id) && !in_array($horaOcupada->curso->nrc, $nrcs)) {
                        $nrcs[] = $horaOcupada->curso->nrc;
                        array_push($horasOcupadas,$horaOcupada);   
                }
                // if ($start > $end) {
                    $start += 1;
                // }
            }
        }
        // dd($horasOcupadas);
        /*Guardamos todas las horas que tiene cada curso solapado*/
        $horas = [];
        /*Iteramos para buscar todos los horarios que tiene el curso solapado*/
        foreach ($horasOcupadas as $value) {
            $horasCurso = HorariosNew::with('curso')->where('id_curso', $value->id_curso)
                ->where('id_area', $value->id_area)
                // ->where('dia', $value->dia)
                ->get()
                ->toArray();
            foreach ($horasCurso as $item) {
                $horaConDatos = [
                    'id_area' => $item['id_area'],
                    'hora' => $item['hora'],
                    'dia' => $item['dia'],
                    // 'nrc' => $value->curso->nrc,
                    'id_curso' =>$value->curso->id
                ];
                $horas[] = $horaConDatos;
            }
        }
        // dd($horas);
        //Agrupar y simplificar. El array ordenara los cursos con sus horas correspondientes.
        $horariosArray = []; 
        foreach ($horas as $value) {
            $idCurso = $value['id_curso'];
            $dia = $value['dia'];
            $hora = $value['hora'];
        
            if (!isset($horariosArray[$dia])) {
                $horariosArray[$dia] = [];
            }
        
            if (!isset($horariosArray[$dia][$idCurso])) {
                $horariosArray[$dia][$idCurso] = [
                    'id_curso' => $idCurso,
                    'dia' => $dia,
                    'horas' => []
                ];
            }
        
            $horariosArray[$dia][$idCurso]['horas'][] = $hora;
        }
        /*Ordenamos e indexamos el arreglo*/
        $horariosArray = array_values($horariosArray);
        // dd($horariosArray, $horasOcupadas);
        // dd($horariosArray);
        //$horasOcupadas nos servira para saber cuantas itereaciones dar
        //$horariosArray nos pertmitira acceder a todos los horarios de esos cursos
        return [$horasOcupadas, $horariosArray];
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
            'codigo' => 'required|between:5,8',
            // 'dia.0' => 'required',
            // 'hora_inicio.0' => 'required',
            // 'hora_final.0' => 'required',
        ]; 


        $customMessages = [
            'curso_nombre.required' => 'El nombre del curso es obligatorio',
            'nrc.required' => 'El :attribute es obligatorio',
            'nrc.between' => 'El :attribute debe tener de :min a :max caracteres',
            'ciclo.required' => 'El :attribute es obligatorio',
            'area.required' => 'El área es obligatorio',
            'departamento.required' => 'El :attribute es obligatorio',
            'alumnos_registrados.required' => 'El campo alumnos registrados es obligatorio',
            'alumnos_registrados.between' => 'Los alumnos registrados debe ser entre 1 al limite de cupos regitrado',
            'cupo.between' => 'El :attribute debe ser entre 1 a 60.',
            'cupo.required' => 'El campo :attribute es obligatorio',
            'nivel.required' => 'El :attribute es obligatorio',
            'profesor.required' => 'El nombre del :attribute es obligatorio',
            'codigo.required' => 'El :attribute es obligatorio',
            'codigo.between' => 'El :attribute debe ser de 5 a 8 caracteres.',
            // 'dia.0.required' => 'El día es obligatorio',
            // 'hora_inicio.0.required' => 'La hora de inicio es obligatorio',
            // 'hora_final.0.required' => 'La hora final es obligatorio',
            // 'dia.1.required' => 'El día es obligatorio',
            // 'hora_inicio.1.required' => 'La hora de inicio es obligatorio',
            // 'hora_final.1.required' => 'La hora final es obligatorio',
        ];
        foreach ($request->dia as $key => $value) {
            if(isset($request->dia[$key]) || isset($request->hora_inicio[$key]) || isset($request->hora_final[$key])){
                $validationRules['dia.' . $key] = 'required';
                $validationRules['hora_inicio.' . $key] = 'required';
                $validationRules['hora_final.'. $key] = 'required';
                $customMessages['dia.' . $key . '.required'] = 'El día es obligatorio';
                $customMessages['hora_inicio.' . $key .  '.required'] = 'La hora de inicio es obligatoria';
                $customMessages['hora_final.'. $key . '.required'] = 'La hora final es obligatoria';
            }
        }
        // dd($customMessages);
        $request->validate($validationRules, $customMessages);
    }

    private static function validarCiclo($ciclo){
        $year = intval(substr($ciclo, 0, 4));//obtenemos el año
        if(!$year)
            return 'Formato de ciclo registrado inválido debe ser YYYY[A-B]';  
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
                return 'El ciclo ingresado es inválido, debe ser un año vigente y tener el ciclo A o B correspondiente';
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