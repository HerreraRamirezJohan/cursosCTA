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
                            <label for="Nombre">Nombre del curso:</label>
                            <input type="text" name="curso_nombre" id="nombre" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="nrc">Nrc:</label>
                            <input type="text" name="nrc" id="nrc" class="form-control">
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
                                    <option value="{{ $item->id }}">
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
                                    <option>{{ $item }}</option>
                                    {{-- Datos del DB --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="AlumnosR">Alumnos registrados:</label>
                            <input type="number" name="alumnos_registrados" id="alumnos_registrados" min="0"
                                class="form-control">
                        </div>

                    <div class="mb-3">
                        <label for="Nivel">Nivel:</label>
                        <select id="nivel" class="form-select" name="nivel" class="form-control">
                            <option selected disabled>Elegir</option>
                            <option>Licenciatura</option>
                            <option>Maestría</option>
                            <option>Doctorado</option>
                        </select>
                    </div>


                        <div class="mb-3">
                            <label for="Profesor">Profesor:</label>
                            <input type="text" name="profesor" id="profesor" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="Codigo">Codigo:</label>
                            <input type="text" name="codigo" id="codigo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="estatus">Día</label>
                            <select id="estatus" class="form-select" name="dia[]" required>
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
                            <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control" min="07:00"
                                max="21:00" required>
                        </div>

                        <div class="mb-3">
                            <label for="horario" class="validationDefault04">Fin de Curso</label>
                            <input id="hora_final" type="time" name="hora_final[]" class="form-control" min="07:00"
                                max="21:00" required>
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
            </div>
        </div>
    </div>

    <script >
        //Input de ciclo inhabilitado
        // document.getElementById('ciclo').readOnly = true
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
