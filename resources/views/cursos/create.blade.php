@extends('layouts.app')
@section('content')
    @php
        $contador = 0;
        $horarioErrors = collect(session('errorsHorario'));
        $cursoMismoCiclo = collect(session('cursoMismoCiclo'));
        if (!empty($cursoMismoCiclo->all())) {
            $item = $cursoMismoCiclo[1];
        }
    @endphp
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    @if ($errors->has('alert'))
        <script>
            alert("{{ $errors->first('alert') }}");
        </script>
    @endif
    <div class="container">
        @while ($errors->has('hora_inicio.' . $contador))
        @foreach(['hora_inicio', 'hora_final', 'dia'] as $campo)
            @if ($errors->has($campo . '.' . $contador))
                <div class="alert alert-danger mt-2" role="alert">
                    {{ $errors->get($campo . '.' . $contador)[0] }}
                </div>
            @endif
        @endforeach
        @php
            $contador++;
        @endphp
    @endwhile
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h1 class="text-center text-muted mb-5">Crear curso</h1>
                <div class="col-md-5 w-100">
                    @if (!empty($cursoMismoCiclo->all()))
                        <!-- Button trigger modal -->
                        <div class="alert alert-danger" role="alert">
                            <p class="d-inline-block my-0 me-3">{{ $cursoMismoCiclo[0] }}</p>

                            <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                data-bs-target="#modal{{ $item->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </button>

                            <p class="">{{ $cursoMismoCiclo[2] }}</p>
                            @include('cursos.layouts.cursosModalCiclo')
                        </div>
                    @endif
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
                        <div class="d-md-flex d-lg-flex justify-content-between gap-5">
                            <div class="mb-3 w-100">
                                <label for="nrc">Nrc:</label>
                                <input type="number" name="nrc" id="nrc" class="form-control" min="0"
                                    value="{{ old('nrc') }}" pattern="[0-9]+" oninput="validarNumero(this)"
                                    onKeyPress="if(this.value.length==10) return false;" required>
                                @if ($errors->has('nrc'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('nrc') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 w-100">
                                <label for="cupo">Cupo:</label>
                                <input type="number" name="cupo" id="cupo" min="0" class="form-control"
                                    max="60" value="{{ old('cupo') }}" pattern="[0-9]+"
                                    oninput="validarNumero(this)" onKeyPress="if(this.value.length==2) return false;"
                                    required>
                                @if ($errors->has('cupo'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('cupo') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 w-100">
                                <label for="alumnos_registrados">Alumnos registrados:</label>
                                <input type="number" name="alumnos_registrados" id="alumnos_registrados" min="0"
                                    class="form-control" max="60" value="{{ old('alumnos_registrados') }}"
                                    pattern="[0-9]+" oninput="validarNumero(this)"
                                    onKeyPress="if(this.value.length==2) return false;"required>
                                @if (session('errorsHorario'))
                                    @if (isset($horarioErrors['alumnosMayor']))
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $horarioErrors['alumnosMayor'] }}
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="mb-3 w-100">
                                <label for="Ciclo">Ciclo:</label>
                                <input id="ciclo" class="form-control" name="ciclo" value="{{ old('ciclo') }}" {{-- {{ $cursos_ciclo ? "readOnly value=$cursos_ciclo" : '' }} --}}
                                    onKeyPress="if(this.value.length==5) return false;" >
                                @if (session('errorsHorario'))
                                    @if (isset($horarioErrors['ciclo']))
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $horarioErrors['ciclo'] }}
                                        </div>
                                    @endif
                                @endif
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
                        <div class="d-md-flex d-lg-flex justify-content-between gap-5">
                            <div class="mb-3 w-100">
                                <label for="Area">Área:</label>
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
                        <div class="d-md-flex d-lg-flex justify-content-between gap-5">
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
                                <label for="Codigo">Código del profesor:</label>
                                <input type="number" name="codigo" id="codigo" class="form-control" min="0"
                                    value="{{ old('codigo') }}" onKeyPress="if(this.value.length==8) return false;"
                                    required>
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
                        <h3>Horario</h3>
                        {{-- [Inicio] Alerts de validaciones de horario --}}
                        @if (session('errorsHorario'))
                            @foreach ($horarioErrors as $key => $item)
                                @if ($key !== 'ciclo' && $key !== 'alumnosMayor' && $key !== 'uniqueNrc')
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <p>{{ $item }}</p>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        {{-- [Final] Alerts de validaciones de horario --}}
                        {{-- Primer horario --}}
                        <div class="d-md-flex d-lg-flex justify-content-between gap-5">
                            <div class="mb-3 w-100">
                                <label for="estatus">Día</label>
                                <select id="estatus" class="form-select" name="dia[]" required>
                                    <option selected disabled>Elegir</option>
                                    <option {{ old('dia.0') == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                                    <option {{ old('dia.0') == 'Martes' ? 'selected' : '' }}>Martes</option>
                                    <option {{ old('dia.0') == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
                                    <option {{ old('dia.0') == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                                    <option {{ old('dia.0') == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                                    <option {{ old('dia.0') == 'Sábado' ? 'selected' : '' }}>Sábado</option>
                                </select>
                            </div>
                            <div class="mb-3 w-100">
                                <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
                                <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
                                    min="07:00" max="21:00" value="{{ old('hora_inicio.0') }}" required>
                            </div>
                            <div class="mb-3 w-100">
                                <label for="horario" class="validationDefault04">Hora final del curso</label>
                                <input id="hora_final" type="time" name="hora_final[]" class="form-control"
                                    min="07:00" max="21:00" value="{{ old('hora_final.0') }}" required>
                            </div>
                        </div>
                        {{-- Segundo horario --}}
                        <div class="d-flex me-3" id="containerButtons">
                            <div class="btn btn-success mb-4 me-3" id="btnAgregar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    fill="currentColor" class="bi bi-plus-square me-2" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                <input class="flex-grow-1" type="button" value="Agregar nuevo horario" id="btn"
                                    style="all:unset">
                            </div>
                            <div class="btn btn-danger mb-4 me-2 d-none" id="btnEliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z">
                                    </path>
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z">
                                    </path>
                                </svg>
                                <input class="flex-grow-1" type="button" value="Eliminar horario" style="all:unset">
                            </div>
                        </div>

                        <div id="formulariosContainer">
                            <!-- Aquí se agregarán los formularios -->
                        </div>

                </div>
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
                <h3>Curso con el que interfiere:</h3>
                <div class="row d-flex justify-content-center">{{-- Contenedor de cursos solapados --}}
                    @foreach ($cursos->unique('id_curso') as $key => $item)
                        @if (isset($item['curso']))
                            {{-- ¿Existe horario solapado? --}}
                            @include('cursos.layouts.cursosCard')
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
        function validarNumero(input) {
            input.value = input.value.replace(/\D/g, ''); // Remover cualquier carácter no numérico
        }
    </script>
@endsection
