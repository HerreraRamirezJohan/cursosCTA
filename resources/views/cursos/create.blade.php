@extends('layouts.app')
@section('content')
    {{-- @dd(old('departamento')) --}}
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
                <h1 class="text-center text-muted mb-5">Crear curso</h1>
                <div class="col-md-5 mx-auto">
                    <form action="{{ route('guardar') }}" method="post" id="guardarCurso">
                        @csrf
                        {{-- @include('cursos.form') --}}
                        <div class="mb-3">
                            {{-- Lanzamos la alerta en caso de error --}}
                            <label for="Nombre">Nombre del curso:</label>
                            <input type="text" name="curso_nombre" id="nombre" class="form-control"
                                value="{{ old('curso_nombre') }}">
                        </div>
                        <div class="mb-3">
                            <label for="nrc">Nrc:</label>
                            <input type="text" name="nrc" id="nrc" class="form-control"
                                value="{{ old('nrc') }}">
                        </div>
                        <div class="mb-3">
                            <label for="Ciclo">Ciclo:</label>
                            <input id="ciclo" class="form-control" value="{{ $cursos_ciclo }}" name="ciclo" readOnly>
                            {{-- <label for="">*Nota: Solo puedes asignar un ciclo cuando es el primer curso.</label> --}}
                        </div>
                        <div class="mb-3">
                            <label for="Observaciones">Observaciones:</label>
                            <textarea name="observaciones" id="observaciones" class="form-control">Ninguna</textarea>
                            {{-- <text type="text" name="email" value="{{isset( $employe->email)?$employe->email:''}}" id="email"> --}}
                        </div>

                        <div class="mb-3">
                            <label for="Area">Area:</label>
                            <select id="area" class="form-select js-example-basic-single" name="area"
                                class="form-control">
                                <option selected disabled>Elegir</option>
                                @foreach ($cursos_area as $item)
                                    <option value="{{ $item->id }}" {{ old('area') == $item->id ? 'selected' : '' }}>
                                        {{ $item->sede . ' - ' . $item->edificio . ' - ' . $item->area }}
                                    </option>
                                    {{-- Datos del DB --}}
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Departamento">Departamento:</label>
                            <select id="departamento" class="form-select" name="departamento" class="form-control">
                                <option selected disabled>Elegir</option>
                                @foreach ($cursos_departamento as $item)
                                    <option {{ old('departamento') == $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                    {{-- Datos del DB --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="AlumnosR">Alumnos registrados:</label>
                            <input type="number" name="alumnos_registrados" id="alumnos_registrados" min="0"
                                class="form-control" value="{{ old('alumnos_registrados') }}">
                        </div>

                        <div class="mb-3">
                            <label for="Nivel">Nivel:</label>
                            <select id="nivel" class="form-select" name="nivel" class="form-control">
                                <option selected disabled>Elegir</option>
                                <option {{ old('nivel') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                <option {{ old('nivel') == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                <option {{ old('nivel') == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="Profesor">Profesor:</label>
                            <input type="text" name="profesor" id="profesor" class="form-control"
                                value="{{ old('profesor') }}">
                        </div>

                        <div class="mb-3">
                            <label for="Codigo">Codigo:</label>
                            <input type="text" name="codigo" id="codigo" class="form-control"
                                value="{{ old('codigo') }}">
                        </div>
                        <div class="mb-3">
                            <label for="estatus">Día</label>
                            <select id="estatus" class="form-select" name="dia[]">
                                <option selected disabled>Elegir</option>
                                <option {{ old('dia.0') == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                                <option {{ old('dia.0') == 'Martes' ? 'selected' : '' }}>Martes</option>
                                <option {{ old('dia.0') == 'Miercoles' ? 'selected' : '' }}>Miercoles</option>
                                <option {{ old('dia.0') == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                                <option {{ old('dia.0') == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                                <option {{ old('dia.0') == 'Sabado' ? 'selected' : '' }}>Sabado</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="horario" class="validationDefault04">Inicio de Curso</label>
                            <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control" min="07:00"
                                max="21:00" value="{{ old('hora_inicio.0') }}">
                        </div>

                        <div class="mb-3">
                            <label for="horario" class="validationDefault04">Fin de Curso</label>
                            <input id="hora_final" type="time" name="hora_final[]" class="form-control" min="07:00"
                                max="21:00" value="{{ old('hora_final.0') }}">
                        </div>

                        {{-- Segundo horario --}}
                        <div class="mb-3">
                            <input class="mb-3" type="button" value="Agregar nuevo horario" id="btn">
                            <div id="formulario" style="display: none">

                                <div class="mb-3">
                                    <label for="estatus">Día</label>
                                    <select id="estatus" class="form-select" name="dia[]">
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
                                    <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
                                        min="07:00" max="21:00">
                                </div>

                                <div class="mb-3">
                                    <label for="horario" class="validationDefault04">Fin de Curso</label>
                                    <input id="hora_final" type="time" name="hora_final[]" class="form-control"
                                        min="07:00" max="21:00">
                                </div>
                            </div>
                        </div>
                        {{-- Segundo horario Final --}}
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mx-2">Agregar</button>
                            <a href="{{ route('inicio') }}" class="btn btn-danger mx-2">Cancelar</a>
                        </div>
                    </form>
                </div>
                <div>

                </div>
            </div>{{-- Final contenedor de formulario --}}
            {{-- Inicio de cursos existentes --}}
            @if (session('cursosExistentes'))
                <div class="alert alert-danger align-items-center">
                    @php
                        $cursos = collect(session('cursosExistentes'));
                    @endphp

                    <h3>Los horarios solapados son los siguientes.</h3>
                    <div class="row">{{-- Contenedor de cursos solapados --}}
                        @foreach ($cursos as $key => $curso)
                        @if (isset($curso)){{-- ¿Existe horario solapado? --}}
                            <div class="col-6">
                                <table class="table table-bordered border-dark">
                                    <tr>
                                        <td colspan="2" rowspan="2" class="col-6 fw-bolder align-middle">
                                            {{$curso['curso']->curso_nombre}}
                                        </td>
                                        <td colspan="2"><span class="fw-semibold">Area:</span> {{isset($curso['area']->area) ? $curso['area']->area : 'No registrada'}}</td>
                                    </tr>
                        
                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Ciclo:</span> {{$curso['curso']->ciclo}}</td>
                                    </tr>
                        
                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Departamento:</span> {{$curso['curso']->departamento}}</td>
                                        <td class="align-middle text-capitalize">{{$curso->dia}}</td>
                                    </tr>
                        
                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Sede:</span> {{isset($curso['area']->sede) ? $curso['area']->sede : 'No asignada'}}</td>
                                        <td>{{ date('H:i', strtotime($curso->hora_inicio)) . '-' . date('H:i', strtotime($curso->hora_final)) }}</td>
                                    </tr>
                                    <tr>
                                        @auth
                                        <td colspan="4">
                                            <div class="row align-items-center justify-content-center my-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <a href="{{ route('editar', $curso['curso']->id) }}" class="text-reset p-5">
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
        {{-- Final de la clase de row --}}
    </div>

    <script>
        //Formulario extra de horario
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
    </script>
@endsection
