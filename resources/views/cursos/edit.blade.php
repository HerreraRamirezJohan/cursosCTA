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
                            <select id="area" class="form-select js-example-basic-single" name="area" class="form-control">
                                @foreach ($cursos_area as $area)
                                    <option value="{{ $area->id }}" {{$horariosDelCurso[0]->id_area === $area->id ? 'selected' : ''}}>
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
                                    <option {{$item === $curso->departamento ? 'selected' : ''}}>
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
                            <input type="text" name="profesor" value="{{$curso->profesor}}"
                                id="profesor" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="Codigo" class="">Codigo:</label>
                            <input type="text" name="codigo" value="{{$curso->codigo}}" id="codigo"
                                class="form-control" required>
                        </div>
                        
                        {{-- Extraemos los horarios del curso --}}
                        <h3>Horarios</h3>                                
                        @foreach($horariosDelCurso as $horario) 
                            {{-- iteramos los horarios que tenga --}}
                            <input type="text" name="horariosId[]" hidden readonly value="{{$horario->id}}">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="estatus">Día</label>
                                    <select id="estatus" class="form-select text-capitalize" name="dia[]">
                                        {{-- Generamos un array de los option y mediante un operador ternario validamos cual 
                                            dia se encuentra en la DB para colocar el texto 'selected' para despues colocar el dia--}}
                                        @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'] as $dia)
                                            <option value="{{ $dia }}" {{ $horario->dia === $dia ? 'selected' : '' }}>
                                                {{ $dia }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="horario" class="validationDefault04">Inicio de Curso</label>
                                    <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
                                        min="07:00" max="21:00" value="{{$horario->hora_inicio}}">
                                </div>

                                <div class="mb-3">
                                    <label for="horario" class="validationDefault04">Fin de Curso</label>
                                    <input id="hora_final" type="time" name="hora_final[]" class="form-control"
                                        min="07:00" max="21:00" value="{{$horario->hora_final}}">
                                </div>
                            </div>
                            {{-- Segundo horario Final --}}
                        @endforeach


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
    