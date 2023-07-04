<div class="btn btn-success mb-4">
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
<div id="formulario1" style="display: none">
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
        @if ($errors->has('dia.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('dia.1')[0] }}
            </div>
        @endif
    </div>

    <div class="mb-3 w-100">
        <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
        <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
            min="07:00" max="21:00" value="{{ old('hora_inicio.1') }}">
        @if ($errors->has('hora_inicio.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('hora_inicio.1')[0] }}
            </div>
        @endif
    </div>

    <div class="mb-3 w-100">
        <label for="horario" class="validationDefault04">Hora final del curso</label>
        <input id="hora_final" type="time" name="hora_final[]" class="form-control"
            min="07:00" max="21:00" value="{{ old('hora_final.1') }}">
        @if ($errors->has('hora_final.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('hora_final.1')[0] }}
            </div>
        @endif
    </div>
</div>
<div id="formulario2" style="display: none">
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
        @if ($errors->has('dia.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('dia.1')[0] }}
            </div>
        @endif
    </div>

    <div class="mb-3 w-100">
        <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
        <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
            min="07:00" max="21:00" value="{{ old('hora_inicio.1') }}">
        @if ($errors->has('hora_inicio.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('hora_inicio.1')[0] }}
            </div>
        @endif
    </div>

    <div class="mb-3 w-100">
        <label for="horario" class="validationDefault04">Hora final del curso</label>
        <input id="hora_final" type="time" name="hora_final[]" class="form-control"
            min="07:00" max="21:00" value="{{ old('hora_final.1') }}">
        @if ($errors->has('hora_final.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('hora_final.1')[0] }}
            </div>
        @endif
    </div>
</div><div id="formulario3" style="display: none">
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
        @if ($errors->has('dia.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('dia.1')[0] }}
            </div>
        @endif
    </div>

    <div class="mb-3 w-100">
        <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
        <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
            min="07:00" max="21:00" value="{{ old('hora_inicio.1') }}">
        @if ($errors->has('hora_inicio.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('hora_inicio.1')[0] }}
            </div>
        @endif
    </div>

    <div class="mb-3 w-100">
        <label for="horario" class="validationDefault04">Hora final del curso</label>
        <input id="hora_final" type="time" name="hora_final[]" class="form-control"
            min="07:00" max="21:00" value="{{ old('hora_final.1') }}">
        @if ($errors->has('hora_final.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('hora_final.1')[0] }}
            </div>
        @endif
    </div>
</div><div id="formulario4" style="display: none">
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
        @if ($errors->has('dia.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('dia.1')[0] }}
            </div>
        @endif
    </div>

    <div class="mb-3 w-100">
        <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
        <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
            min="07:00" max="21:00" value="{{ old('hora_inicio.1') }}">
        @if ($errors->has('hora_inicio.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('hora_inicio.1')[0] }}
            </div>
        @endif
    </div>

    <div class="mb-3 w-100">
        <label for="horario" class="validationDefault04">Hora final del curso</label>
        <input id="hora_final" type="time" name="hora_final[]" class="form-control"
            min="07:00" max="21:00" value="{{ old('hora_final.1') }}">
        @if ($errors->has('hora_final.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('hora_final.1')[0] }}
            </div>
        @endif
    </div>
</div><div id="formulario5" style="display: none">
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
        @if ($errors->has('dia.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('dia.1')[0] }}
            </div>
        @endif
    </div>

    <div class="mb-3 w-100">
        <label for="horario" class="validationDefault04">Hora de inicio del curso</label>
        <input id="hora_inicio" type="time" name="hora_inicio[]" class="form-control"
            min="07:00" max="21:00" value="{{ old('hora_inicio.1') }}">
        @if ($errors->has('hora_inicio.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('hora_inicio.1')[0] }}
            </div>
        @endif
    </div>

    <div class="mb-3 w-100">
        <label for="horario" class="validationDefault04">Hora final del curso</label>
        <input id="hora_final" type="time" name="hora_final[]" class="form-control"
            min="07:00" max="21:00" value="{{ old('hora_final.1') }}">
        @if ($errors->has('hora_final.1'))
            <div class="alert alert-danger mt-2" role="alert">
                {{ $errors->get('hora_final.1')[0] }}
            </div>
        @endif
    </div>
</div>