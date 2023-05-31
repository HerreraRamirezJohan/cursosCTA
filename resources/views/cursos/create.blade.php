@extends('layouts.app')
@section('content')
    @php
        $horarioErrors = collect(session('errorsHorario'));        
    @endphp
    {{-- @dd(old('departamento')) --}}
    <script>
        // In your Javascript (external .js resource or <script> tag)
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
                                    value="{{ old('nrc') }}" pattern="[0-9]+" oninput="validarNumero(this)"
                                    onKeyPress="if(this.value.length==11) return false;" required>
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
                                @if ($errors->has('alumnos_registrados'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->first('alumnos_registrados') }}
                                    </div>
                                @endif
                                @if (session('alumnosMayor'))
                                    <div class="alert alert-danger align-items-center text-center mt-3" role="alert">
                                        {{ session('alumnosMayor') }}
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
                            <div class="alert alert-danger mt-2" role="alert">
                                @foreach ($horarioErrors as $item)
                                    <p>{{ $item }}</p>
                                @endforeach
                            </div>
                        @endif
                        {{-- [Final] Alerts de validaciones de horario --}}

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
                        <div class="btn btn-success d-flex justify-content-center align-items-center mb-4"
                            style="width: 400px">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-plus-square me-2" viewBox="0 0 16 16">
                                <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <input class="flex-grow-1" type="button" value="Agregar nuevo horario" id="btn"
                                style="all:unset">
                        </div>
                        <div id="formulario" style="display: none">

                            <div class="mb-3 w-100">
                                <label for="dia2">Día</label>
                                <select id="dia2" class="form-select" name="dia[]">
                                    <option selected disabled>Elegir</option>
                                    <option {{ old('dia.1') == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                                    <option {{ old('dia.1') == 'Martes' ? 'selected' : '' }}>Martes</option>
                                    <option {{ old('dia.1') == 'Miercoles' ? 'selected' : '' }}>Miercoles</option>
                                    <option {{ old('dia.1') == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                                    <option {{ old('dia.1') == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                                    <option {{ old('dia.1') == 'Sabado' ? 'selected' : '' }}>Sabado</option>
                                </select>
                            </div>

                            <div class="mb-3 w-100">
                                <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
                                <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
                                    min="07:00" max="21:00" value="{{ old('hora_inicio.1') }}">
                            </div>

                            <div class="mb-3 w-100">
                                <label for="horario" class="validationDefault04">Hora final del curso</label>
                                <input id="hora_final" type="time" name="hora_final[]" class="form-control"
                                    min="07:00" max="21:00" value="{{ old('hora_final.1') }}">
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
                    @foreach ($cursos->unique('id_curso') as $key => $curso)
                        {{-- @dd($curso['curso']->id) --}}
                        {{-- @dd($curso->dia) --}}
                        @if (isset($curso['curso']))
                            {{-- ¿Existe horario solapado? --}}
                            <div class="col-6">
                                <table class="table table-bordered border-dark h-100">
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
                                            <td colspan="2" style="border-style: none none none solid;"
                                                class="fw-semibold">

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                                data-bs-target="#modal{{ $curso->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                        <path
                                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                    </svg>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modal{{ $curso->id }}" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel{{ $curso->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="modalLabel{{ $curso->id }}">Datos del curso
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered align-middle">
                                                                    <thead class="align-middle">
                                                                        <tr>
                                                                            <th scope="col">Profesor:</th>
                                                                            <th scope="col" class="fw-normal">
                                                                                {{ $curso['curso']->profesor }}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">Código del profesor:</th>
                                                                            <td class="fw-normal">
                                                                                {{ $curso['curso']->codigo }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Nrc:</th>
                                                                            <td class="fw-normal">{{ $curso['curso']->nrc }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Nivel:</th>
                                                                            <td class="fw-normal text-capitalize">
                                                                                {{ $curso['curso']->nivel }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Cupo:</th>
                                                                            <td class="fw-normal">{{ $curso['curso']->cupo }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Alumnos registrados:</th>
                                                                            <td class="fw-normal">
                                                                                {{ $curso['curso']->alumnos_registrados }}</td>
                                                                        </tr>
                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                Opciones de Curso:
                                            </td>
                                            <td colspan="2" style="border-style:none solid none none;">
                                                <div class="d-flex">
                                                    {{-- Boton editar --}}
                                                    <div class="d-flex w-50 justify-content-center align-items-center">
                                                        <a href="{{ route('editar', $curso->curso->id) }}"
                                                            class="text-decoration-none d-flex btn btn-outline-dark">
                                                            <p class="m-0 pe-3 ">Editar</p>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                                height="25" fill="currentColor"
                                                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd"
                                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    {{-- Boton eliminar --}}
                                                    <div class="d-flex w-50 justify-content-center align-items-center">
                                                        <a id="eliminar"
                                                            class="text-decoration-none d-flex btn btn-outline-dark"
                                                            onclick="deleteConfirm('{{ route('eliminar', $curso->curso->id) }}')">
                                                            <p class="m-0 pe-3">Eliminar</p>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                                height="25" fill="currentColor" class="bi bi-trash3"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                            </svg>
                                                        </a>
                                                    </div>
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
        // validarDias();
        testVariablePHP({{empty($horarioErrors) ? null : $horarioErrors}})
        function testVariablePHP($data){
            console.log(data);
        }
        function validarNumero(input) {
            input.value = input.value.replace(/\D/g, ''); // Remover cualquier carácter no numérico
        }
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

        function guardarCurso() {
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
        function deleteConfirm(url) {
                Swal.fire({
                    title: '¿Estás seguro de eliminar el curso?',
                    text: "Esta acción no podrá ser revertida",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Curso eliminado correctamente',
                            '',
                            'success'
                        ).then(() => {
                            window.location.href = url; // Redirige a la URL de eliminación
                        });
                    }
                });
            }
    </script>
@endsection
