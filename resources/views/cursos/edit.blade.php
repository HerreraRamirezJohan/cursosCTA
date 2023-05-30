@extends('layouts.app')
@section('content')
    @php
        $url = session('url'); // Obtener la URL de la variable de sesión
    @endphp

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <div class="container">
        @if ($errors->has('errorsHorario'))
            <script>
                alert("{{ $errors->first('alert') }}");
            </script>
        @endif

        @if (session('cursoModificado'))
            <div class="alert alert-success mt-3 d-flex justify-content-between" role="alert">
                <div>{{ session('cursoModificado') }}</div>
                <div>
                    <a href="{{ $url }}" class="align-bottom"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" fill="currentColor" class="bi bi-arrow-left align-middle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg> REGRESAR</a>
                </div>
            </div>
        @endif

        <div class="row">
            @if ($errors->any())
                {{-- @dd($errors) --}}
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif
            <div class="col-md-12 mx-auto">
                <h1 class="text-center text-muted mb-5">Editar curso</h1>
                <div class="col-md-5 w-100">
                    <form action="{{ route('actualizar', $curso) }}" method="post" id="guardarCurso">
                        @csrf
                        @method('put')
                        {{-- @include('cursos.form') --}}
                        <div class="mb-3">
                            {{-- <input type="hidden" name="filter_url" value="{{ url()->previous() }}"> --}}
                            <label for="nombre" class="">Nombre del curso:</label>
                            <input type="text" name="curso_nombre"
                                value="{{ old('curso_nombre', $curso->curso_nombre) }}" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between gap-5">
                            <div class="mb-3 w-100">
                                <label for="nrc" class="">Nrc:</label>
                                <input type="number" name="nrc" value="{{ old('nrc', $curso->nrc) }}" id="nrc"
                                    min="0" class="form-control" pattern="[0-9]+" oninput="validarNumero(this)"
                                    onKeyPress="if(this.value.length==10) return false;" required>
                                    @if (session('nrcLength'))
                                    <div class="alert alert-danger align-items-center text-center mt-3" role="alert">
                                        {{ session('nrcLength') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 w-100">
                                <label for="cupo" class="">Cupo:</label>
                                <input type="number" name="cupo" value="{{ old('cupo', $curso->cupo) }}" id="cupo"
                                    min="0" class="form-control" pattern="[0-9]+" oninput="validarNumero(this)"
                                    onKeyPress="if(this.value.length==2) return false;" required>
                                @if ($errors->has('cupo'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('cupo') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 w-100">
                                <label for="alumnos_registrados" class="">Alumnos registrados:</label>
                                <input type="number" name="alumnos_registrados"
                                    value="{{ old('alumnos_registrados', $curso->alumnos_registrados) }}"
                                    id="alumnos_registrados" min="0" class="form-control" pattern="[0-9]+"
                                    oninput="validarNumero(this)"
                                    onKeyPress="if(this.value.length==2) return false;"required>
                                    @if (session('alumnosMayor'))
                                    <div class="alert alert-danger align-items-center text-center mt-3" role="alert">
                                        {{ session('alumnosMayor') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3 w-100">
                                <label for="Ciclo" class="">Ciclo:</label>
                                <input type="text" name="ciclo" value="{{ old('ciclo', $curso->ciclo) }}"
                                    id="ciclo" class="form-control" required readOnly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Observaciones" class="">Observaciones:</label>
                            <textarea name="observaciones" id="observaciones" class="form-control h-100"
                                value="{{ old('observaciones', $curso->observaciones) }}">Ninguna</textarea>
                            {{-- <text type="text" name="email" value="{{isset( $employe->email)?$employe->email:''}}" id="email"> --}}
                        </div>
                        <div class="d-flex justify-content-between gap-5">
                            <div class="mb-3 w-100">
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

                            <div class="mb-3 w-100">
                                <label for="Departamento" class="validationDefault04">Departamento:</label>
                                <select id="validationDefault04" class="form-select js-example-basic-single"
                                    name="departamento" class="form-control" required>
                                    @foreach ($cursos_departamento as $item)
                                        <option {{ $item === $curso->departamento ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                        {{-- Datos del DB --}}
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between gap-5">
                            <div class="mb-3 flex-grow-2">
                                <label for="Nivel" class="validationDefault04">Nivel:</label>
                                <select id="validationDefault04" class="form-select" name="nivel" class="form-control"
                                    required>
                                    <option disabled>Elegir</option>
                                    {{-- Usamos operador ternario para saber cual es el elemento seleccionado --}}
                                    <option {{ $curso->nivel === 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                    <option {{ $curso->nivel === 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                    <option {{ $curso->nivel === 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                </select>
                            </div>
                            <div class="mb-3 flex-grow-2">
                                <label for="Codigo" class="">Codigo del profesor:</label>
                                <input type="number" name="codigo" value="{{ $curso->codigo }}" id="codigo"
                                    min="0" class="form-control"
                                    onKeyPress="if(this.value.length==8) return false;" required>
                                    @if (session('codigoLength'))
                                    <div class="alert alert-danger align-items-center text-center mt-3" role="alert">
                                        {{ session('codigoLength') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3
                                    flex-grow-1">
                                <label for="Profesor" class="">Profesor:</label>
                                <input type="text" name="profesor" value="{{ $curso->profesor }}" id="profesor"
                                    class="form-control" required>
                            </div>
                        </div>
                        {{-- Extraemos los horarios del curso --}}
                        <h3>Horarios</h3>

                        {{-- [Inicio] Alerts de validaciones de horario --}}
                        @if(session('errorsHorario'))
                            @php
                                $horarioErrors = collect(session('errorsHorario'));
                            @endphp    
                            <div class="alert alert-danger mt-2" role="alert">
                                @foreach($horarioErrors as $item)
                                    <p>{{$item}}</p>
                                @endforeach
                            </div>
                        @endif
                        {{-- [Final] Alerts de validaciones de horario --}}

                        @foreach ($horariosDelCurso as $key => $horario)
                            @if ($key == 1)
                                <div class="d-flex align-items-center justify-content-end">
                                    <a id="eliminar" hre class=" ms-3 text-decoration-none btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z">
                                            </path>
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z">
                                            </path>
                                        </svg>
                                        <span class="text-white">Eliminar segundo horario</span>
                                    </a>
                                </div>
                            @endif
                            {{-- iteramos los horarios que tenga --}}
                            <div class="d-flex justify-content-between gap-5">
                                <input type="text" name="horariosId[]" hidden readonly value="{{ $horario->id }}">
                                <div class="mb-3 w-100">
                                    {{-- <div class="mb-3"> --}}
                                    <label for="dia1">Día</label>
                                    <select id="dia{{ $key + 1 }}" class="form-select text-capitalize"
                                        name="dia[]">
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

                                <div class="mb-3 w-100">
                                    <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
                                    <input id="hora_inicio{{ $key + 1 }}" type="time" name="hora_inicio[]"
                                        class="form-control" min="07:00" max="21:00"
                                        value="{{ $horario->hora_inicio }}">
                                </div>

                                <div class="mb-3 w-100">
                                    <label for="horario" class="validationDefault04">Hora final del curso</label>
                                    <input id="hora_final{{ $key + 1 }}" type="time" name="hora_final[]"
                                        class="form-control" min="07:00" max="21:00"
                                        value="{{ $horario->hora_final }}">
                                </div>
                                {{-- </div> --}}
                            </div>

                            {{-- Segundo horario Final --}}
                            {{-- @dd($validacion_horario) --}}
                            @if ($validacion_horario == 1)
                                {{-- Segundo horario --}}
                                <div class="btn btn-success d-flex justify-content-center align-items-center mb-4"
                                    style="width: 400px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        fill="currentColor" class="bi bi-plus-square me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                    <input class="flex-grow-1" type="button" value="Agregar nuevo horario"
                                        id="btn" style="all:unset">
                                </div>

                                <div id="formulario" style="display:none">
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
                            @endif
                </div>
                @endforeach

                <div class="d-flex justify-content-center">
                    <a href="{{ $url }}" class="btn btn-danger mx-2">Cancelar</a>
                    <button type="button" class="btn btn-primary mx-2" id="editBtn"
                        onclick="confirmEdit()">Actualizar</button>
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

                <h3>Curso con el que interfiere:</h3>
                <div class="row d-flex justify-content-center">{{-- Contenedor de cursos solapados --}}
                    {{-- {{dd($curso->id)}} --}}
                    @foreach ($cursos as $key => $item)
                        @if (isset($item) && $item->id_curso !== $curso->id)
                            {{-- ¿Existe horario solapado? --}}
                            <div class="col-6">
                                <table class="table table-bordered border-dark">
                                    <tr>
                                        <td colspan="2" rowspan="2" class="col-6 fw-bolder align-middle">
                                            {{ $item['curso']->curso_nombre }}
                                        </td>
                                        <td colspan="2"><span class="fw-semibold">Area:</span>
                                            {{ isset($item['area']->area) ? $item['area']->area : 'No registrada' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Ciclo:</span>
                                            {{ $item['curso']->ciclo }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Departamento:</span>
                                            {{ $item['curso']->departamento }}</td>
                                        <td class="align-middle text-capitalize">{{ $item->dia }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><span class="fw-semibold">Sede:</span>
                                            {{ isset($item['area']->sede) ? $item['area']->sede : 'No asignada' }}</td>
                                        <td>{{ date('H:i', strtotime($item->hora_inicio)) . '-' . date('H:i', strtotime($item->hora_final)) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        @auth
                                            <td colspan="4">
                                                <div class="row align-items-center justify-content-center my-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <a href="{{ route('editar', $item['curso']->id) }}"
                                                            class="text-reset p-5">
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
        function validarNumero(input) {
            input.value = input.value.replace(/\D/g, ''); // Remover cualquier carácter no numérico
        }

        botonHorarioExtra();

        function confirmEdit() {
            let formSubmit = document.querySelector('#guardarCurso');

            Swal.fire({
                    title: '¿Deseas guardar los cambios?',
                    showDenyButton: true,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `Seguir editando`,
                })
                .then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        formSubmit.submit();
                    } else if (result.isDenied) {
                        Swal.fire('Datos no guardados', '', 'info')
                    }
                })
        }
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
    </script>
@endsection
