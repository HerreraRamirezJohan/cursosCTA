@extends('layouts.app')
@section('content')
    @php
        $url = session('url'); // Obtener la URL de la variable de sesión
        $horarioErrors = collect(session('errorsHorario'));  //Obtenemos los errores de los horarios
        // dd($horarioErrors);
    @endphp
    {{-- @dd($horarios) --}}

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                theme: 'bootstrap-5'});
        });
    </script>
    <div class="container">
        @if (session('success'))
            <div id="alert" class="alert alert-danger align-items-center text-center mt-3">
                {{ session('success') }}
            </div>
        @endif
        @if (session('cursoModificado'))
            <div class="alert alert-success mt-3 d-flex justify-content-between" role="alert">
                <div>{{ session('cursoModificado') }}</div>
                <div>
                    <a href="{{ $url}}" class="align-bottom"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" fill="currentColor" class="bi bi-arrow-left align-middle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg> REGRESAR</a>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h1 class="text-center text-muted mb-5">Editar curso</h1>
                <div class="col-md-5 w-100">
                    {{-- @dd($curso) --}}
                    <form action="{{ route('actualizar', $curso->id) }}" method="post" id="guardarCurso">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            {{-- <input type="hidden" name="filter_url" value="{{ url()->previous() }}"> --}}
                            <label for="nombre" class="validationDefault04">Nombre del curso:</label>
                            <input type="text" name="curso_nombre"
                                value="{{ old('curso_nombre', $curso->curso_nombre) }}" class="form-control" required>
                        </div>
                        @if ($errors->has('curso_nombre'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('curso_nombre') }}
                            </div>
                        @endif
                        
                        <div class="d-md-flex d-lg-flex justify-content-between gap-5">
                            <div class="mb-3 w-100">
                                <label for="nrc" class="validationDefault04">Nrc:</label>
                                <input type="number" name="nrc" value="{{ old('nrc', $curso->nrc) }}" id="nrc"
                                    min="0" class="form-control" pattern="[0-9]+" oninput="validarNumero(this)"
                                    onKeyPress="if(this.value.length==10) return false;" required>
                                @if ($errors->has('nrc'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('nrc') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 w-100">
                                <label for="cupo" class="validationDefault04">Cupo:</label>
                                <input type="number" name="cupo" value="{{ old('cupo', $curso->cupo) }}" id="cupo" min="0" class="form-control" pattern="[0-9]+" oninput="validarNumero(this)"                                    onKeyPress="if(this.value.length==2) return false;" required>
                                @if ($errors->has('cupo'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('cupo') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 w-100">
                                <label for="alumnos_registrados" class="validationDefault04">Alumnos registrados:</label>
                                <input type="number" name="alumnos_registrados" value="{{ old('alumnos_registrados', $curso->alumnos_registrados) }}" id="alumnos_registrados" min="0" class="form-control" pattern="[0-9]+" oninput="validarNumero(this)" onKeyPress="if(this.value.length==2) return false;"required>
                                    @if ($errors->has('alumnos_registrados'))
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $errors->first('alumnos_registrados') }}
                                        </div>
                                    @endif
                                    @if (session('errorsHorario'))
                                        @if(isset($horarioErrors['alumnosMayor']))
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{$horarioErrors['alumnosMayor']}}
                                        </div>
                                    @endif
                                @endif 
                            </div>

                            <div class="mb-3 w-100">
                                <label for="Ciclo" class="validationDefault04">Ciclo:</label>
                                <input type="text" name="ciclo" value="{{ old('ciclo', $curso->ciclo) }}" id="ciclo" class="form-control" required readOnly>
                                @if ($errors->has('ciclo'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('ciclo') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Observaciones" class="validationDefault04">Observaciones:</label>
                            <textarea name="observaciones" id="observaciones" class="form-control h-100" value="{{ old('observaciones', $curso->observaciones) }}">{{$curso->observaciones ?? 'Ninguna'}}</textarea>
                            {{-- <text type="text" name="email" value="{{isset( $employe->email)?$employe->email:''}}" id="email"> --}}
                        </div>
                        <div class="d-md-flex d-lg-flex justify-content-between gap-5">
                            <div class="mb-3 w-100">
                                <label for="Area">Área:</label>
                                <select id="area" class="form-select js-example-basic-single" name="area" class="form-control" required>
                                    @foreach ($cursos_area as $area)
                                        <option value="{{ $area->id }}"
                                            {{ $horarios[0]->id_area === $area->id ? 'selected' : '' }}>
                                            {{ $area->sede . ' - ' . $area->edificio . ' - ' . $area->area }}
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
                                <label for="Departamento" class="validationDefault04">Departamento:</label>
                                <select id="validationDefault04" class="form-select js-example-basic-single" name="departamento" class="form-control" required>
                                    @foreach ($cursos_departamento as $item)
                                        <option {{ $item === $curso->departamento ? 'selected' : '' }}>
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
                                <label for="Nivel" class="validationDefault04">Nivel:</label>
                                <select id="validationDefault04" class="form-select" name="nivel" class="form-control" required>
                                    <option disabled>Elegir</option>
                                    {{-- Usamos operador ternario para saber cual es el elemento seleccionado --}}
                                    <option {{ $curso->nivel === 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                    <option {{ $curso->nivel === 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                    <option {{ $curso->nivel === 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                </select>
                                @if ($errors->has('nivel'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('nivel') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 flex-grow-2">
                                <label for="Codigo" class="">Código del profesor:</label>
                                <input type="number" name="codigo" value="{{ $curso->codigo }}" id="codigo" min="0" class="form-control" onKeyPress="if(this.value.length==8) return false;" required>
                                    @if ($errors->has('codigo'))
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $errors->first('codigo') }}
                                        </div>
                                    @endif
                            </div>
                            <div class="mb-3 flex-grow-1">
                                <label for="Profesor" class="">Profesor:</label>
                                <input type="text" name="profesor" value="{{ $curso->profesor }}" id="profesor" class="form-control" required>
                                @if ($errors->has('profesor'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('profesor') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Extraemos los horarios del curso --}}
                        <h3>Horarios</h3>

                        {{-- [Inicio] Alerts de validaciones de horario --}}
                        @if (session('errorsHorario'))
                                @foreach ($horarioErrors as $key => $item)
                                    @if($key !== 'ciclo' && $key !== 'alumnosMayor')
                                        <div class="alert alert-danger mt-2" role="alert">
                                            <p>{{ $item }}</p>
                                        </div>
                                    @endif
                                @endforeach
                        @endif
                        {{-- [Final] Alerts de validaciones de horario --}}
                        {{-- @dd(session('cursosExistentes')) --}}
   
                        @foreach ($horarios as $key => $horario)
                            @if ($key >= 1)
                                <div class="d-flex align-items-center justify-content-end">
                                    <a id="eliminar" class=" ms-3 text-decoration-none btn btn-danger" onclick="deleteConfirm('{{route('eliminarHorario', ['id_curso' => $horario->id_curso, 'dia' => $horario->dia])}}', 'Horario')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                        </svg><span class="text-white">Eliminar horario</span>
                                    </a>
                                </div>
                            @endif
                            {{-- iteramos los horarios que tenga --}}
                            <div class="d-md-flex d-lg-flex justify-content-between gap-5">
                                <input type="text" name="horariosId[]" hidden readonly value="{{ $horario->id }}">
                                <div class="mb-3 w-100">
                                    <label for="dia1">Día</label>
                                    <select id="dia{{ $key + 1 }}" class="form-select text-capitalize" name="dia[]">
                                        {{-- Generamos un array de los option y mediante un operador ternario validamos cual 
                                            dia se encuentra en la DB para colocar el texto 'selected' para despues colocar el dia --}}
                                        @foreach (['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'] as $dia)
                                            <option value="{{ $dia }}"
                                                {{ $horario->dia === $dia ? 'selected' : '' }}>
                                                {{ $dia }}
                                            </option>
                                        @endforeach
                                        @if ($errors->has('dia.'.$key))
                                            <div class="alert alert-danger mt-2" role="alert">
                                                {{ $errors->get('dia.'.$key)[0] }}
                                            </div>
                                        @endif
                                    </select>
                                </div>

                                <div class="mb-3 w-100">
                                    <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
                                    {{-- @dd($horario) --}}
                                    <input id="hora_inicio{{ $key + 1 }}" type="time" name="hora_inicio[]" class="form-control" min="07:00" max="21:00" value="{{ $horario->hora_inicio  }}">
                                    @if ($errors->has('hora_inicio.'.$key))
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $errors->get('hora_inicio.'.$key)[0] }}
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-3 w-100">
                                    <label for="horario" class="validationDefault04">Hora final del curso</label>
                                    <input id="hora_final{{ $key + 1 }}" type="time" name="hora_final[]" class="form-control" min="07:00" max="21:00"
                                    value="{{ date('H:i', strtotime($horario->hora_final . ' +55 minutes')) }}"
                                    {{-- value="{{$horario->hora_final}}" --}}
                                    >
                                    @if ($errors->has('hora_final.'.$key))
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $errors->get('hora_final.'.$key)[0] }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- Segundo horario Final --}}
                        @endforeach
                            {{-- Botones y cotenido en caso de querer agregar mas horarios --}}
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                </svg>
                                <input class="flex-grow-1" type="button" value="Eliminar horario" style="all:unset">             
                            </div>
                        </div>
                        
                        <div id="formulariosContainer">
                            <!-- Aquí se agregarán los formularios -->
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ $url }}" class="btn btn-danger mx-2">Cancelar</a>
                            <button type="button" class="btn btn-primary mx-2" id="editBtn" onclick="guardarCurso()">Actualizar</button>
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
                {{-- @dd($cursos[2], $cursos[0]) --}}
                {{-- @dd($cursos[0]) --}}
                <h3>Curso con el que interfiere:</h3>
                <div class="row d-flex justify-content-center">{{-- Contenedor de cursos solapados --}}
                    @foreach ($cursos[0] as $key => $item) 
                    {{-- @dd($cursos[0], $cursos[1]) --}}
                        @if (isset($item) && $item->id_curso !== $curso->id)
                            @include('cursos.layouts.cursosCard')
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
        function validarNumero(input) {
            input.value = input.value.replace(/\D/g, ''); // Remover cualquier carácter no numérico
        }
@endsection
