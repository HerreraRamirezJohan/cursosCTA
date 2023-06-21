@extends('layouts.app')

@section('content')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    @php
        $hourExists = null;
        $nrc = null;
    @endphp

    <div class="container">
        <div class="table-responsive">
            <div class="row mt-1 mb-4">
                <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                    {{-- <div class="text-sm-start text-md-start text-lg-center">
                    <label for="area">Área</label>
                </div> --}}

                    <form action="{{ route('agenda') }}">
                        @csrf
                        <div class="d-flex gap-3 my-0">
                            <select id="area" class="form-select w-100 js-example-basic-single" name="edificio">
                                <option selected value="">Todos los edificios</option>
                                @foreach ($edificios->unique('edificio') as $item)
                                    @if ($item->edificio != '-')
                                        <option value="{{ $item->edificio }}">
                                            {{ $item->edificio }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                    <h1 class="text-center mt-3 mb-2">Lunes</h1>

                </div>
            </div>
            <div>
                {{-- @dd($resultados) --}}
                <h4 class="fs-2 text-center">{{ $edificioRequest }}</h4>
            </div>
            <table class="table table-bordered border-secondary">
                <thead>
                    <tr>
                        <th></th>
                        @foreach ($aulas as $aula)
                        <th class="fw-normal">
                            @if (preg_match('/\d+/', $aula->area, $matches))
                                {{ $matches[0] }}
                            @else
                                {{ $aula->area }}
                            @endif
                        </th>
                    @endforeach
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach (range(7, 21) as $hour)
                        <tr>
                            <td>{{ sprintf('%02d', $hour) }}:00</td>
                            @foreach ($aulas as $aula)
                                @php
                                    $flag = null;
                                    $content = ''; // Variable para almacenar el contenido de la celda
                                    $id = '';
                                    foreach ($horasFiltradas as $item) {
                                        if ($aula->id == $item['id_area'] && $hour == $item['hora']) {
                                            $content = $item['nrc'];
                                            $id = $item['id'];
                                            $flag = true;
                                            break; // Salir del bucle si se encuentra una coincidencia
                                        }
                                    }
                                @endphp
                                <td style="background-color:{{ $flag == true ? '#FE3E3F' : '#e6e6e6' }}">
                                    <a href="{{$flag == true ? route('editar', $id) : route('crear')}}" class="text-decoration-none text-light fw-medium">{{ $content ? $content : '' }}</a>
                                </td>

                                {{-- <td onclick="myFunction('{{ $flag }}', '{{ $id }}', '{{ $content }}')">
                                    <a class="text-decoration-none text-light">{{ $content ? $content : '' }}</a>
                                </td> --}}

                                
                                {{-- @php
                                $hourExists = null;
                                        foreach ($resultados as $key => $item) {
                                            foreach ($allNrc as $key2 => $nrc) {
                                                if ($aula->id == $item['id_area']) {
                                                    $hourExists = in_array($hour, $item['horas']);
                                                }
                                            }
                                        }
                                    @endphp --}}
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    </div>
@endsection


<script>
    function myFunction(flag, id, content) {
        console.log(flag, id, content);
        let backgroundColor = flag == 1 ? '#ff0033' : '#0ddb44';
        let url = flag == 'true' ? "{{ route('editar', ':id') }}" : "{{ route('crear') }}";
        url = url.replace(':id', id);

        // Hacer algo con el color de fondo o redireccionar a la URL según sea necesario
        console.log("Color de fondo:", backgroundColor);
        console.log("URL:", url);
    }
</script>
