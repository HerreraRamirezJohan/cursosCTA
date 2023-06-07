<div class="mb-3">
    <label for="nombre" class="">Nombre del curso:</label>
    <input type="text" name="curso_nombre" value="{{ old('curso_nombre', $curso->curso_nombre) }}" class="form-control" required>
</div>
<div class="mb-3">
    <label for="nrc" class="">Nrc:</label>
    <input type="text" name="nrc" value="{{ old('nrc', $curso->nrc) }}" id="nrc" class="form-control" required>
</div>
<div class="mb-3">
    <label for="Ciclo" class="">Ciclo:</label>
    <input type="text" name="ciclo" value="{{ old('ciclo', $curso->ciclo) }}" id="ciclo" class="form-control" required>
</div>
<div class="mb-3">
    <label for="Observaciones" class="">Observaciones:</label>
    <textarea name="observaciones" id="observaciones" class="form-control"
        value="{{ old('observaciones', $curso->observaciones) }}"></textarea>
    {{-- <text type="text" name="email" value="{{isset( $employe->email)?$employe->email:''}}" id="email"> --}}
</div>
<div class="mb-3">
    <label for="Departamento" class="validationDefault04">Departamento:</label>
    <select id="validationDefault04" class="form-select" name="departamento" class="form-control" required>
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
        value="{{ old('alumnos_registrados', $curso->alumnos_registrados) }}" id="alumnos_registrados" min="0" class="form-control" required>
</div>

<div class="mb-3">
    <label for="Nivel" class="validationDefault04">Nivel:</label>
    <select id="validationDefault04" class="form-select" name="nivel" class="form-control" required>
        <option selected disabled>{{ old('nivel', $curso->nivel) }}</option>
        <option>Licenciatura</option>
        <option>Maestría</option>
        <option>Doctorado</option>
    </select>
</div>


<div class="mb-3">
    <label for="Profesor" class="">Profesor:</label>
    <input type="text" name="profesor" value="{{ old('profesor', $curso->profesor) }}" id="profesor" class="form-control" required>
</div>

<div class="mb-3">
    <label for="Codigo" class="">Código:</label>
    <input type="text" name="codigo" value="{{ old('codigo', $curso->codigo) }}" id="codigo" class="form-control" required>
</div>

<div class="mb-3">
    <label for="Día" class="">Día:</label>
    <input type="text" name="dia" value="{{ old('dia', $horario->dia) }}" id="dia" class="form-control" required>
</div>

<div class="mb-3">
    <label for="hora_inicio" class="">Inicio del curso</label>
    <input type="text" name="hora_inicio" value="{{ old('hora_inicio', $horario->hora_inicio) }}" id="hora_inicio" class="form-control" required>
</div>


