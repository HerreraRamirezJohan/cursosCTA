<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<form class="row" action="{{ route('mostrar') }}">

    {{-- [Nombre del curso] --}}
    <div class="d-flex flex-column align-items-center mt-2">
        <label for="nombre_curso">Nombre del curso</label>
        <input type="text" class="form-control w-50 mb-4" name="curso_nombre">
    {{-- [Departamento] --}}
        <label for="departamento">Departamento</label>
        <select id="departamento" class="form-select w-50 mb-4" name="departamento">
            <option selected disabled>Elegir</option>
            @foreach ($cursos_departamento as $item)
                <option value="{{ $item }}">{{ $item }}</option>
                {{-- Datos del DB --}}
            @endforeach
        </select>
    </div>
    {{-- Inicio Selects [Departamento, Sede y Estatus] --}}
    <div class="row row-cols-lg-auto align-items-center justify-content-center mt-0" style="gap:1rem 2rem">

        {{-- [Sede] --}}
        <div>
            <label for="sede">Sede</label>
            <select id="sede" class="form-select" name="sede">
                <option selected disabled>Elegir</option>
                <option value="Belenes">Belenes</option>
                <option value="La Normal">La Normal</option>
            </select>
        </div>
        {{-- [Estatus] --}}
        <div>
            <label for="estatus" class="validationDefault04">Ciclo</label>
            <select id="validationDefault04" class="form-select" name="ciclo" required>
                <option selected disabled>Elegir</option>
                @foreach ($cursos_ciclo as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
        {{-- [Dia] --}}
        <div>
            <label for="estatus">Día</label>
            <select id="estatus" class="form-select" name="dia">
                <option selected disabled>Elegir</option>
                <option value="lunes">Lunes</option>
                <option value="martes">Martes</option>
                <option value="miercoles">Miercoles</option>
                <option value="jueves">Jueves</option>
                <option value="viernes">Viernes</option>
                <option value="sabado">Sabado</option>
            </select>
        </div>
        {{-- 
        <div>
            <label for="estatus" class="validationDefault04">Horario</label>
            <select id="validationDefault04" class="form-select" name="horario">
                <option selected disabled value="">Elegir</option>
                @foreach ($horarios as $item)
                    <option>{{ $item }}</option>
                @endforeach
            </select>
        </div> --}}

        {{-- InputTime para buscar por hora de inicio del curso --}}
        <div>
            <label for="horario" class="validationDefault04">Inicio de Curso</label>
            <input id="hora_inicio" type="time" name="hora_inicio" class="form-control" min="07:00"
                max="21:00">
        </div>
    </div> {{-- Final contenedor 4 campos --}}
    {{-- [Area] --}}
    <div class="d-flex flex-column align-items-center mt-3">
        <label for="area">Area</label>
        <select id="area" class="form-select js-example-basic-single w-50" name="area">
            <option selected disabled>Elegir</option>
            @foreach ($cursos_area as $item)
                <option value="{{ $item->id }}">
                    {{ $item->sede . ' - ' . $item->edificio . ' - ' . $item->area }}
                </option>
                {{-- Datos del DB --}}
            @endforeach

        </select>
    </div>

    <div>

    </div>
    {{-- Final Selects [Departamento, Sede y Estatus] --}}

    {{-- Boton de filtros --}}
    <div class="col-sm-12 col-md-12 col-lg-1 mx-auto">
        <button type="submit" class="w-100 btn btn-primary mt-3 w-2">Filtrar</button>
    </div>

</form>
