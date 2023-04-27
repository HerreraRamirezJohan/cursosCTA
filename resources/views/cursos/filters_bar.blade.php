<form class="row" action="{{ route('mostrar') }}">

    {{-- Inicio Selects [Departamento, Sede y Estatus] --}}
    <div class="row row-cols-lg-auto g-3 align-items-center justify-content-center">

        {{-- [Nombre del curso] --}}
        <div>
            <label for="nombre_curso">Nombre del curso</label>
            <input type="text" class="form-control" name="curso_nombre">
        </div>
        {{-- [Departamento] --}}
        <div>
            <label for="departamento">Departamento</label>
            <select id="departamento" class="form-select" name="departamento">
                <option selected disabled>Elegir</option>
                @foreach ($cursos_departamento as $item)
                    <option>{{ $item }}</option>
                    {{-- Datos del DB --}}
                @endforeach
            </select>
        </div>
        {{-- [Sede] --}}
        <div>
            <label for="sede">Sede</label>
            <select id="sede" class="form-select" name="sede">
                <option selected disabled>Elegir</option>
                @foreach ($cursos_sede as $item)
                    <option>{{ $item }}</option>
                @endforeach
            </select>
        </div>
        {{-- [Estatus] --}}
        <div>
            <label for="estatus" class="validationDefault04">Ciclo</label>
            <select id="validationDefault04" class="form-select" name="ciclo" required>
                <option selected disabled value="">Elegir</option>
                @foreach ($cursos_ciclo as $item)
                    <option>{{ $item }}</option>
                @endforeach
            </select>
        </div>
        {{-- [Dia] --}}
        <div>
            <label for="estatus">Día</label>
            <select id="estatus" class="form-select" name="dia">
                <option selected disabled>Elegir</option>
                <option>Lunes</option>
                <option>Martes</option>
                <option>Miercoles</option>
                <option>Jueves</option>
                <option>Viernes</option>
                <option>Sabado</option>
            </select>
        </div>

        <div>
            <label for="estatus" class="validationDefault04">Horario</label>
            <select id="validationDefault04" class="form-select" name="horario">
                <option selected disabled value="">Elegir</option>
                @foreach ($horarios as $item)
                    <option>{{ $item }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div>

    </div>
    {{-- Final Selects [Departamento, Sede y Estatus] --}}

    {{-- Boton de filtros --}}
    <div class="col-sm-12 col-md-1 mx-auto">
      <button type="submit" class="w-100 btn btn-primary mt-3 w-2">Filtrar</button>  
    </div>
    
</form>
