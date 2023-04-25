<form action="" class="row">
    
    {{-- Inicio Selects [Departamento, Sede y Estatus] --}}
    <div class="row row-cols-lg-auto g-3 align-items-center justify-content-around">
            {{-- [Departamento] --}}
            <div>
                <label for="departamento">Departamento</label>
                <select id="departamento" class="form-select">
                    <option selected disabled>Elegir</option>
                    @foreach ($cursos as $item)
                        <option>{{$item->departamento}}</option>
                    {{-- Datos del DB --}}
                     @endforeach

                </select>
            </div>
            {{-- [Sede] --}}
            <div>
                <label for="sede">Sede Universitario</label>
                <select id="sede" class="form-select">
                    <option selected disabled>Elegir</option>
                    <option value="1">Belenes</option>
                    <option value="2">La Normal</option>
                </select>
            </div>
            {{-- [Estatus] --}}
            <div>
                <label for="estatus">Ciclo</label>
                <select id="estatus" class="form-select">
                    <option selected disabled>Elegir</option>
                    @foreach ($cursos as $item)
                    <option>{{$item->ciclo}}</option>                    
                    @endforeach
                </select>
            </div>
            {{-- [Dia] --}}
            <div>
                <label for="estatus">Día del curso</label>
                <select id="estatus" class="form-select">
                    <option selected disabled>Elegir</option>
                    <option value="1">Lunes</option>
                    <option value="1">Martes</option>
                    <option value="1">Miercoles</option>
                    <option value="1">Jueves</option>
                    <option value="1">Viernes</option>
                    <option value="1">Sabado</option>
                </select>
            </div>
    </div>
    {{-- Final Selects [Departamento, Sede y Estatus] --}}

    {{--Boton de filtros--}}
    <button type="submit" class="btn btn-primary mt-3 w-2">Submit</button>
</form>