@extends('layouts.app')
@section('content')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <div class="container">
        <div class="row">
            @if ($errors->any())
                {{-- @dd($errors) --}}
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif
            <div class="col-md-12 mx-auto">
                <h1 class="text-center text-muted mb-5">Editar curso</h1>
                <div class="col-md-5 mx-auto">
                    <form action="{{ route('actualizar', $curso) }}" method="post" id="guardarCurso">
                        @csrf
                        @method('put')
                        {{-- @include('cursos.form') --}}
                        <div class="mb-3">
                            <label for="nombre" class="">Nombre del curso:</label>
                            <input type="text" name="curso_nombre"
                                value="{{ old('curso_nombre', $curso->curso_nombre) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nrc" class="">Nrc:</label>
                            <input type="text" name="nrc" value="{{ old('nrc', $curso->nrc) }}" id="nrc"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="Ciclo" class="">Ciclo:</label>
                            <input type="text" name="ciclo" value="{{ old('ciclo', $curso->ciclo) }}" id="ciclo"
                                class="form-control" required readOnly>
                        </div>
                        <div class="mb-3">
                            <label for="Observaciones" class="">Observaciones:</label>
                            <textarea name="observaciones" id="observaciones" class="form-control"
                                value="{{ old('observaciones', $curso->observaciones) }}"></textarea>
                            {{-- <text type="text" name="email" value="{{isset( $employe->email)?$employe->email:''}}" id="email"> --}}
                        </div>

                        <div class="mb-3">
                            <label for="Area">Area:</label>
                            <select id="area" class="form-select js-example-basic-single" name="area"
                                class="form-control">
                                @foreach ($cursos_area as $area)
                                    <option value="{{ $area->id }}"
                                        {{ $horariosDelCurso[0]->id_area === $area->id ? 'selected' : '' }}>
                                        {{ $area->sede . ' - ' . $area->edificio . ' - ' . $area->area }}
                                    </option>
                                    {{-- Datos del DB --}}
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Departamento" class="validationDefault04">Departamento:</label>
                            <select id="validationDefault04" class="form-select" name="departamento" class="form-control"
                                required>
                                @foreach ($cursos_departamento as $item)
                                    <option {{ $item === $curso->departamento ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                    {{-- Datos del DB --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alumnos_registrados" class="">Alumnos registrados:</label>
                            <input type="number" name="alumnos_registrados"
                                value="{{ old('alumnos_registrados', $curso->alumnos_registrados) }}"
                                id="alumnos_registrados" min="0" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="Nivel" class="validationDefault04">Nivel:</label>
                            <select id="validationDefault04" class="form-select" name="nivel" class="form-control"
                                required>
                                <option disabled>Selecciona un nivel</option>
                                {{-- Usamos operador ternario para saber cual es el elemento seleccionado --}}
                                <option {{ $curso->nivel === 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                <option {{ $curso->nivel === 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                <option {{ $curso->nivel === 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="Profesor" class="">Profesor:</label>
                            <input type="text" name="profesor" value="{{ $curso->profesor }}" id="profesor"
                                class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="Codigo" class="">Codigo:</label>
                            <input type="text" name="codigo" value="{{ $curso->codigo }}" id="codigo"
                                class="form-control" required>
                        </div>

                        {{-- Extraemos los horarios del curso --}}
                        <h3>Horarios</h3>
                        @foreach ($horariosDelCurso as $key => $horario)
                            {{-- iteramos los horarios que tenga --}}
                            <input type="text" name="horariosId[]" hidden readonly value="{{ $horario->id }}">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="dia1">Día</label>
                                    <select id="dia{{$key+1}}" class="form-select text-capitalize" name="dia[]">
                                        {{-- Generamos un array de los option y mediante un operador ternario validamos cual 
                                            dia se encuentra en la DB para colocar el texto 'selected' para despues colocar el dia --}}
                                        @foreach (['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'] as $dia)
                                            <option value="{{ $dia }}"
                                                {{ $horario->dia === $dia ? 'selected' : '' }}>
                                                {{ $dia }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="horario" class="validationDefault04">Inicio de Curso</label>
                                    <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
                                        min="07:00" max="21:00" value="{{ $horario->hora_inicio }}">
                                </div>

                                <div class="mb-3">
                                    <label for="horario" class="validationDefault04">Fin de Curso</label>
                                    <input id="hora_final" type="time" name="hora_final[]" class="form-control"
                                        min="07:00" max="21:00" value="{{ $horario->hora_final }}">
                                </div>

                                {{-- Segundo horario Final --}}
                                @if ($validacion_horario == 1)
                                    {{-- Segundo horario --}}
                                    <div class="mb-3">
                                        <input class="mb-3" type="button" value="Agregar nuevo horario"
                                            id="btn">
                                        <div id="formulario" style="display: none">

                                            <div class="mb-3">
                                                <label for="dia2">Día</label>
                                                <select id="dia2" class="form-select" name="dia[]">
                                                    <option selected disabled>Elegir</option>
                                                    <option>Lunes</option>
                                                    <option>Martes</option>
                                                    <option>Miercoles</option>
                                                    <option>Jueves</option>
                                                    <option>Viernes</option>
                                                    <option>Sabado</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="horario" class="validationDefault04">Inicio de Curso</label>
                                                <input id="hora_inicio" type="time" name="hora_inicio[]"
                                                    class="form-control" min="07:00" max="21:00">
                                            </div>

                                            <div class="mb-3">
                                                <label for="horario" class="validationDefault04">Fin de Curso</label>
                                                <input id="hora_final" type="time" name="hora_final[]"
                                                    class="form-control" min="07:00" max="21:00">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach



                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mx-2">Actualizar</button>
                            <a href="{{ route('inicio') }}" class="btn btn-danger mx-2">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Inicio de cursos existentes --}}
            @if (session('cursosExistentes'))
                <div class="alert alert-danger align-items-center text-center mt-3">
                    @php
                        $cursos = collect(session('cursosExistentes'));
                    @endphp

                    <h3>Los horarios solapados son los siguientes.</h3>
                    <div class="row d-flex justify-content-center">{{-- Contenedor de cursos solapados --}}
                        {{-- {{dd($curso->id)}} --}}
                        @foreach ($cursos as $key => $item)
                        @if (isset($item) && $item->id_curso !== $curso->id){{-- ¿Existe horario solapado? --}}
                            <div class="col-6">
                                <table class="table table-bordered border-dark">
                                    <tr>
                                        <td colspan="2" rowspan="2" class="col-6 fw-bolder align-middle">
                                            {{$item['curso']->curso_nombre}}
                                        </td>
                                        <td colspan="2"><span class="fw-semibold">Area:</span> {{isset($item['area']->area) ? $item['area']->area : 'No registrada'}}</td>
                                    </tr>
                        
                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Ciclo:</span> {{$item['curso']->ciclo}}</td>
                                    </tr>
                        
                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Departamento:</span> {{$item['curso']->departamento}}</td>
                                        <td class="align-middle text-capitalize">{{$item->dia}}</td>
                                    </tr>
                        
                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Sede:</span> {{isset($item['area']->sede) ? $item['area']->sede : 'No asignada'}}</td>
                                        <td>{{ date('H:i', strtotime($item->hora_inicio)) . '-' . date('H:i', strtotime($item->hora_final)) }}</td>
                                    </tr>
                                    <tr>
                                        @auth
                                        <td colspan="4">
                                            <div class="row align-items-center justify-content-center my-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <a href="{{ route('editar', $item['curso']->id) }}" class="text-reset p-5">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></a>
                                            </div>
                                        </td>
                                        @endauth
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @endforeach
                    </div>
                    {{-- Final de cursos solapados --}}
                </div>
            @endif
            {{-- Final de cursos existentes --}}
        </div>
    </div>

    <script>
        validarDias();
        botonHorarioExtra();
        //Formulario extra de horario
        function botonHorarioExtra(){
            var btn = document.getElementById('btn'),
            formulario = document.getElementById('formulario');
            contador = 1;
            
            function cambio() {
                if (contador == 0) {
                    formulario.style.display = "none";
                    btn.value = "Agregar horario";
                    contador = 1;
                } else {
                    formulario.style.display = "block";
                    btn.value = "Quitar horario";
                    contador = 0;
                }
            }
            btn.addEventListener('click', cambio, true);
        }
        function validarDias(){
            form = document.querySelector('#guardarCurso');
            form.addEventListener('submit', function (e){
                e.preventDefault();
                console.log([dia1, dia2])
                if(dia1.value === dia2.value){
                    console.log('No puedes colocar el mismo dia que el anterior horario.');
                }else{
                    form.submit();
                }
            });
        }
    </script>
@endsection
