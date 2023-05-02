<div class="mb-3">
    <label for="nrc">Nrc:</label>
    <input type="text" name="nrc" value="{{isset( $employe->name)?$employe->name:''}}" id="nrc" class="form-control">
</div>
<div class="mb-3">
    <label for="Nombre">Nombre del curso:</label>
    <input type="text" name="nombre" value="{{isset( $employe->lastname)?$employe->lastname:''}}" id="nombre" class="form-control">
</div>
<div class="mb-3">
    <label for="Ciclo">Ciclo:</label>
    <input type="text" name="ciclo" value="{{isset( $employe->email)?$employe->email:''}}" id="ciclo" class="form-control">
</div>
<div class="mb-3">
    <label for="Observaciones">Observaciones:</label>
    <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
    {{-- <text type="text" name="email" value="{{isset( $employe->email)?$employe->email:''}}" id="email"> --}}
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
    <input type="number" name="alumnos_registrados" value="{{isset( $employe->email)?$employe->email:''}}" id="alumnos_registrados" min="0" class="form-control">
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
    <input type="text" name="profesor" value="{{isset( $employe->email)?$employe->email:''}}" id="profesor" class="form-control">
</div>

<div class="mb-3">
    <label for="Codigo">Codigo:</label>
    <input type="text" name="codigo" value="{{isset( $employe->email)?$employe->email:''}}" id="codigo" class="form-control">
</div>

<div>
    
</div>