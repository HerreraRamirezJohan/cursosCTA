@extends('layouts.app')
@section('content')
    {{-- @dd(old('departamento')) --}}
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    @if ($errors->has('alert'))
        <script>
            alert("{{ $errors->first('alert') }}");
        </script>
    @endif
    {{-- @if ($errors->has('confirm'))
    <script>
        if (confirm("{{ $errors->first('confirm') }}")) {
        } else {
            window.location.href = "{{ route('inicio') }}";
        }
    </script>
    @endif --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h1 class="text-center text-muted mb-5">Crear curso</h1>
                <div class="col-md-5 w-100">
                    <form action="{{ route('guardar') }}" method="post" id="guardarCurso">
                        @csrf
                        <div class="mb-3">
                            <label for="Nombre">Nombre del curso:</label>
                            <input type="text" name="curso_nombre" id="nombre" class="form-control"
                                value="{{ old('curso_nombre') }}" required>
                        </div>
                        @if ($errors->has('curso_nombre'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('curso_nombre') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-between gap-5">
                            <div class="mb-3 w-100">
                                <label for="nrc">Nrc:</label>
                                <input type="number" name="nrc" id="nrc" class="form-control" min="0"
                                    value="{{ old('nrc') }}" required>
                                @if ($errors->has('nrc'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('nrc') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 w-100">
                                <label for="cupo">Cupo:</label>
                                <input type="number" name="cupo" id="cupo" min="0" class="form-control"
                                    max="60" value="{{ old('cupo') }}" required>
                                @if ($errors->has('cupo'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('cupo') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 w-100">
                                <label for="alumnos_registrados">Alumnos registrados:</label>
                                <input type="number" name="alumnos_registrados" id="alumnos_registrados" min="0"
                                    class="form-control" max="60" value="{{ old('alumnos_registrados') }}" required>
                                @if ($errors->has('alumnos_registrados'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('alumnos_registrados') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 w-100">
                                <label for="Ciclo">Ciclo:</label>
                                <input id="ciclo" class="form-control" value="{{ $cursos_ciclo }}" name="ciclo"
                                    readOnly>
                                {{-- <label for="">*Nota: Solo puedes asignar un ciclo cuando es el primer curso.</label> --}}
                                @if ($errors->has('ciclo'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('ciclo') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Observaciones">Observaciones:</label>
                            <textarea name="observaciones" id="observaciones" class="form-control h-100">Ninguna</textarea>
                            {{-- <text type="text" name="email" value="{{isset( $employe->email)?$employe->email:''}}" id="email"> --}}
                        </div>
                        <div class="d-flex justify-content-between gap-5">
                            <div class="mb-3 w-100">
                                <label for="Area">Area:</label>
                                <select id="area" class="form-select js-example-basic-single" name="area"
                                    class="form-control" required>
                                    <option selected disabled>Elegir</option>
                                    @foreach ($cursos_area as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('area') == $item->id ? 'selected' : '' }}>
                                            {{ $item->sede . ' - ' . $item->edificio . ' - ' . $item->area }}
                                        </option>
                                        {{-- Datos del DB --}}
                                    @endforeach
                                    
                                </select>
                                @if ($errors->has('area'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('area') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 w-100">
                                <label for="Departamento">Departamento:</label>
                                <select id="departamento" class="form-select js-example-basic-single" name="departamento"
                                    class="form-control" required>
                                    <option selected disabled>Elegir</option>
                                    @foreach ($cursos_departamento as $item)
                                        <option {{ old('departamento') == $item ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                        {{-- Datos del DB --}}
                                    @endforeach
                                </select>
                                @if ($errors->has('departamento'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('departamento') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-between gap-5">
                            <div class="mb-3 flex-grow-2">
                                <label for="Nivel">Nivel:</label>
                                <select id="nivel" class="form-select" name="nivel" class="form-control" required>
                                    <option selected disabled>Elegir</option>
                                    <option {{ old('nivel') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                    <option {{ old('nivel') == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                    <option {{ old('nivel') == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                </select>
                                @if ($errors->has('nivel'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('nivel') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 flex-grow-2">
                                <label for="Codigo">Codigo del profesor:</label>
                                <input type="number" name="codigo" id="codigo" class="form-control" min="0"
                                    value="{{ old('codigo') }}" required>
                                @if ($errors->has('codigo'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('codigo') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 flex-grow-1">
                                <label for="Profesor">Profesor:</label>
                                <input type="text" name="profesor" id="profesor" class="form-control"
                                    value="{{ old('profesor') }}" required>
                                @if ($errors->has('profesor'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('profesor') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Primer horario --}}
                        <div class="d-flex justify-content-between gap-5">
                            <div class="mb-3 w-100">
                                <label for="estatus">Día</label>
                                <select id="estatus" class="form-select" name="dia[]" required>
                                    <option selected disabled>Elegir</option>
                                    <option {{ old('dia.0') == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                                    <option {{ old('dia.0') == 'Martes' ? 'selected' : '' }}>Martes</option>
                                    <option {{ old('dia.0') == 'Miercoles' ? 'selected' : '' }}>Miercoles</option>
                                    <option {{ old('dia.0') == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                                    <option {{ old('dia.0') == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                                    <option {{ old('dia.0') == 'Sabado' ? 'selected' : '' }}>Sabado</option>
                                </select>
                                @if ($errors->has('dia.0'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->get('dia.0')[0] }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 w-100">
                                <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
                                <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
                                    min="07:00" max="21:00" value="{{ old('hora_inicio.0') }}" required>
                                @if ($errors->has('hora_inicio.0'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->get('hora_inicio.0')[0] }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 w-100">
                                <label for="horario" class="validationDefault04">Hora final del curso</label>
                                <input id="hora_final" type="time" name="hora_final[]" class="form-control"
                                    min="07:00" max="21:00" value="{{ old('hora_final.0') }}" required>
                                @if ($errors->has('hora_final.0'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->get('hora_final.0')[0] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Segundo horario --}}
                        <div class="btn btn-success d-flex justify-content-center align-items-center mb-4" style="width: 400px">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square me-2" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                              </svg>
                            <input class="flex-grow-1" type="button" value="Agregar nuevo horario" id="btn" style="all:unset">
                        </div>
                        <div id="formulario" style="display: none">

                            <div class="mb-3 w-100">
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

                            <div class="mb-3 w-100">
                                <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
                                <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
                                    min="07:00" max="21:00">
                            </div>

                            <div class="mb-3 w-100">
                                <label for="horario" class="validationDefault04">Hora final del curso</label>
                                <input id="hora_final" type="time" name="hora_final[]" class="form-control"
                                    min="07:00" max="21:00">
                            </div>
                        </div>
                </div>
                {{-- </div> --}}
                {{-- Segundo horario Final --}}
                <div class="d-flex justify-content-center">
                    <a href="{{ route('inicio') }}" class="btn btn-danger mx-2">Cancelar</a>
                    <button type="button" class="btn btn-primary mx-2" onclick="guardarCurso()">Agregar</button>
                </div>
                </form>
            </div>
        </div>{{-- Final contenedor de formulario --}}
        {{-- Inicio de cursos existentes --}}
        @if (session('cursosExistentes'))
            <div class="alert alert-danger align-items-center text-center mt-3">
                @php
                    $cursos = collect(session('cursosExistentes'));
                @endphp
                {{-- @dd($cursos['curso']->id) --}}
                <h3>Curso con el que interfiere:</h3>
                <div class="row d-flex justify-content-center">{{-- Contenedor de cursos solapados --}}
                    @foreach ($cursos as $key => $curso)
                        {{-- @dd($curso['curso']->id) --}}
                        {{-- @dd($curso->dia) --}}
                        @if (isset($curso['curso']))
                            {{-- ¿Existe horario solapado? --}}
                            <div class="col-6">
                                <table class="table table-bordered border-dark">
                                    <tr>
                                        {{-- @dd($curso) --}}
                                        <td colspan="2" rowspan="2" class="col-6 fw-bolder align-middle">
                                            {{ $curso['curso']->curso_nombre }}
                                        </td>
                                        <td colspan="2"><span class="fw-semibold">Area:</span>
                                            {{ isset($curso['area']->area) ? $curso['area']->area : 'No registrada' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Ciclo:</span>
                                            {{ $curso['curso']->ciclo }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            {{ $curso['curso']->departamento }}
                                        </td>
                                        <td class="align-middle text-capitalize">
                                            {{ $curso->dia }}
                                        </td>
                                        @foreach ($horarios as $horario)
                                            {{-- @dd($curso->id_curso, $horario['id_curso']) --}}
                                            @if ($curso->id_curso == $horario['id_curso'])
                                                @if ($curso->dia != $horario['dia'])
                                                    <td class="align-middle text-capitalize">
                                                        {{-- Mostramos el dia que falta mostrar --}}
                                                        {{ $horario['dia'] }}
                                                    </td>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Sede:</span>
                                            {{ isset($curso['area']->sede) ? $curso['area']->sede : 'No asignada' }}
                                        </td>
                                        <td>
                                            {{ date('H:i', strtotime($curso->hora_inicio)) . '-' . date('H:i', strtotime($curso->hora_final)) }}
                                        </td>
                                        {{-- Foreach horarios para las horas --}}
                                        @foreach ($horarios as $horario)
                                            {{-- Validamos que el id del curso sea igual al id del curso de los que tienen 2 horarios  --}}
                                            @if ($curso->id_curso == $horario['id_curso'])
                                                {{-- Si el dia del curso es diferente al dia que tiene 2 horarios muestra la celda --}}
                                                {{-- Esto se hizo teniendo en cuenta que no existen un curso con el mismo dia en caso de tener dos horarios --}}
                                                @if ($curso->dia != $horario['dia'])
                                                    <td>
                                                        {{ date('H:i', strtotime($horario['hora_inicio'])) . '-' . date('H:i', strtotime($horario['hora_final'])) }}
                                                    </td>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @auth
                                            <td colspan="4">
                                                {{-- <div class="row align-items-center justify-content-center my-3"> --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <a href="{{ route('editar', $curso['curso']->id) }}"
                                                        class="text-reset p-5">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></a>
                                                {{-- </div> --}}
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
        // validarDias();
        botonHorarioExtra();
        //Formulario extra de horario
        function botonHorarioExtra() {
            var btn = document.getElementById('btn'),
                formulario = document.getElementById('formulario');
            contador = 1;

            function cambio() {
                if (contador == 0) {
                    formulario.style.display = "none";
                    btn.value = "Agregar nuevo horario";
                    formulario.classList.remove('d-flex', 'justify-content-between', 'gap-5');
                    contador = 1;
                } else {
                    formulario.classList.add('d-flex', 'justify-content-between', 'gap-5');
                    // formulario.style.display = "block";
                    btn.value = "Quitar horario";
                    contador = 0;
                }
            }
            btn.addEventListener('click', cambio, true);

        }
        function guardarCurso(){
            let formSubmit = document.querySelector('#guardarCurso');

            Swal.fire({
            title: '¿Desea guardar el curso?',
            showDenyButton: true,
            confirmButtonText: 'Guardar',
            denyButtonText: `Regresar`,
            })
            .then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    formSubmit.submit();
                }
            })
        }
    </script>
@endsection
