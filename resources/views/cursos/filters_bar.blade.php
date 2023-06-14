<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<form action="{{ route('mostrar') }}" id="form">

    {{-- [Nombre del curso] --}}
    <div class="row mt-2">
        <div class="col-sm-12 text-sm-start col-md-12 text-md-start col-lg-6 text-lg-center offset-lg-3">
            <label for="nombre_curso">Nombre del curso</label>
            <input type="text" class="form-control w-100 mb-3" name="curso_nombre">
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12 text-sm-start col-md-12 text-md-start col-lg-6 text-lg-center offset-lg-3">
            <label for="departamento">Departamento</label>
            <select id="departamento" class="form-select w-100 mb-3" name="departamento">
                <option selected disabled>Elegir</option>
                @foreach ($cursos_departamento as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    {{-- Datos del DB --}}
                @endforeach
            </select>
        </div>
    </div>
    
    {{-- Inicio Selects [Departamento, Sede y Estatus] --}}
    <div class="row row-cols-lg-auto align-items-center justify-content-center mt-0" style="gap:1rem 2rem">
        {{-- [Sede] --}}
        <div>
            <label for="sede">Sede</label>
            <select id="sede" class="form-select" name="sede">
                {{-- <option selected disabled>Elegir</option> --}}
                <option value="Belenes" selected>Belenes</option>
                <option value="La Normal">La Normal</option>
            </select>
        </div>
        {{-- [Estatus] --}}
        <div>
            <label for="validationDefault04">Ciclo</label>
            <select class="form-select" id="validationDefault04" name="ciclo" required>
                <option selected disabled value="">Elegir</option>
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
                <option value="miércoles">Miércoles</option>
                <option value="jueves">Jueves</option>
                <option value="viernes">Viernes</option>
                <option value="sábado">Sábado</option>
            </select>
        </div>
        {{-- InputTime para buscar por hora de inicio del curso --}}
        <div>
            <label for="horario" class="validationDefault04">Inicio de Curso</label>
            <input id="hora_inicio" type="time" name="hora_inicio" class="form-control" min="07:00"
                max="21:00">
        </div>
    </div> {{-- Final contenedor 4 campos --}}
    {{-- [Area] --}}
    <div class="row mt-2">
        <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="text-sm-start text-md-start text-lg-center">
                <label for="area">Área</label>
            </div>
        <select id="area" class="form-select w-100 js-example-basic-single" name="area">
            <option selected value="">Todas las áreas</option>
            @foreach ($cursos_area as $item)
                <option value="{{ $item->id }}">
                    {{ $item->sede . ' - ' . $item->edificio . ' - ' . $item->area }}
                </option>
                {{-- Datos del DB --}}
            @endforeach
        </select>
    </div>
    </div>
    </div>
    {{-- Final Selects [Departamento, Sede y Estatus] --}}
    {{-- Boton de filtros --}}
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3 d-flex mx-auto mb-4">
            <button type="submit" class="w-50 btn btn-primary mt-3 mx-2">Filtrar</button>
            <button type="button" id="limpiarBtn" class="w-50 btn btn-secondary mt-3 mx-2">Limpiar</button>
        </div>
    </div>

</form>

