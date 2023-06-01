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
                                <input id="ciclo" class="form-control" name="ciclo" 
                                {{ $tiempoTranscurrido != '5 months ago' ? "readOnly value=$cursos_ciclo" : '' }}>
                                                   
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
                    @foreach ($cursos->unique('id_curso') as $key => $item)
                        {{-- @dd($curso['curso']->id) --}}
                        {{-- @dd($curso->dia) --}}
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
        // validarDias();
        // testVariablePHP({{empty($horarioErrors) ? null : $horarioErrors}})
        // function testVariablePHP($data){
        //     console.log(data);
        // }
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

                    let inputs = document.querySelectorAll('.inputsHorario2');
                    inputs.forEach(input => {
                        if (input.type === 'select-one') {
                            input.value = 'Elegir';
                        } else {
                            input.value = null;
                        }
                    });
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
