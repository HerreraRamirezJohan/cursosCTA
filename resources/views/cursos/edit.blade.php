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
            <div class="col-md-12 mx-auto">
                <h1 class="text-center text-muted mb-5">Editar curso</h1>
                <div class="col-md-5 mx-auto">
                    <form action="{{ route('actualizar', $curso) }}" method="post">
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
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="Observaciones" class="">Observaciones:</label>
                            <textarea name="observaciones" id="observaciones" class="form-control"
                                value="{{ old('observaciones', $curso->observaciones) }}"></textarea>
                            {{-- <text type="text" name="email" value="{{isset( $employe->email)?$employe->email:''}}" id="email"> --}}
                        </div>

                        <div class="mb-3">
                            <label for="Area">Area:</label>
                            <select id="area" class="form-select js-example-basic-single" name="area" class="form-control">
                                <option selected disabled>Elegir</option>
                                @foreach ($cursos_area as $item)
                                    <option va>{{ $item }}</option>
                                    {{-- Datos del DB --}}
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Departamento" class="validationDefault04">Departamento:</label>
                            <select id="validationDefault04" class="form-select" name="departamento" class="form-control"
                                required>
                                <option selected disabled>{{ old('departamento', $curso->departamento) }}</option>
                                @foreach ($cursos_departamento as $item)
                                    <option>{{ $item }}</option>
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
                                <option selected disabled>{{ old('nivel', $curso->nivel) }}</option>
                                <option>Licenciatura</option>
                                <option>Maestría</option>
                                <option>Doctorado</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="Profesor" class="">Profesor:</label>
                            <input type="text" name="profesor" value="{{ old('profesor', $curso->profesor) }}"
                                id="profesor" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="Codigo" class="">Codigo:</label>
                            <input type="text" name="codigo" value="{{ old('codigo', $curso->codigo) }}" id="codigo"
                                class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="estatus">Día</label>
                            <select id="estatus" class="form-select" name="dia" required>
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
                            <label for="horario" class="validationDefault04">Fin de Curso</label>
                            <input id="hora_final" type="time" name="hora_final" class="form-control" min="07:00"
                                max="21:00" required>
                        </div>

                        <div class="mb-3">
                            <label for="horario" class="validationDefault04">Fin de Curso</label>
                            <input id="hora_final" type="time" name="hora_final" class="form-control" min="07:00"
                                max="21:00" required>
                        </div>



                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mx-2">Actualizar</button>
                            <a href="{{ route('inicio') }}" class="btn btn-danger mx-2">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
