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
        $dia = 'lunes';
        $diasSemana = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
        // dd($horasFiltradas);
        foreach ($horasFiltradas as $key => $value) {
            $dia = $value['dia'];
        }
        
    @endphp

    <div class="container">
        <div class="table-responsive">
            <div class="row mt-1 mb-4">
                <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                    {{-- <div class="text-sm-start text-md-start text-lg-center">
                    <label for="area">Área</label>
                </div> --}}
                    <form action="{{ route('agenda') }}" method="GET" id="form">
                        <div class="d-flex gap-3 align-items-center my-0">
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
                        <div class="d-flex align-items-center justify-content-around">
                            <button class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                                </svg>
                            </button>
                            <h1 class="mt-3 mb-2 text-capitalize" id="diaDB">{{ $dia }}</h1>
                            <input id="diaInput" type="hidden" name="dia" value="lunes">
                            <button class="btn" onclick="cambiarDia(event)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                </svg>
                            </button>

                    </form>

                </div>

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
                                        $dia = $item['dia'];
                                        $flag = true;
                                        break; // Salir del bucle si se encuentra una coincidencia
                                    }
                                }
                            @endphp
                            <td style="background-color:{{ $flag == true ? '#FE3E3F' : '#E4FAF3' }}">
                                <a href="{{ $flag == true ? route('editar', $id) : route('crear') }}"
                                    class="text-decoration-none text-light fw-medium">{{ $content ? $content : '' }}</a>
                            </td>

                            {{-- <td onclick="myFunction('{{ $flag }}', '{{ $id }}', '{{ $content }}')">
                                    <a class="text-decoration-none text-light">{{ $content ? $content : '' }}</a>
                                </td> --}}
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
document.addEventListener('DOMContentLoaded', function() {
    console.log('La página se ha recargado');
    let diaInput = document.getElementById("diaInput");
    let diaInputDB = document.getElementById("diaDB");
    console.log(diaInput);
    diaInput.value = diaInputDB.textContent;

    console.log(diaInput.value);

});

function cambiarDia(event) {
  event.preventDefault(); // Evitar el envío del formulario
  let diaInputDB = document.getElementById("diaDB");
  let diaInput = document.getElementById("diaInput");
  let diasSemana = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
  let diaActual = diaInput.value;
  let indiceActual = diasSemana.indexOf(diaActual);

  if (indiceActual !== -1) {
    let siguienteIndice = (indiceActual + 1) % diasSemana.length;
    let siguienteDia = diasSemana[siguienteIndice];
    diaInput.value = siguienteDia;

    // Obtener los parámetros actuales de la URL
    let urlParams = new URLSearchParams(window.location.search);

    // Construir la nueva URL con los parámetros actuales y el nuevo día
    urlParams.set('dia', siguienteDia);
    let nuevaURL = window.location.pathname + '?' + urlParams.toString();

    // Actualizar la URL sin recargar la página
    history.pushState({}, '', nuevaURL);

    // Crear un formulario dinámicamente
    let form = document.createElement('form');
    form.method = 'GET';
    form.action = '{{ route("agenda") }}';

    // Recorrer los parámetros de la URL y agregarlos al formulario
    urlParams.forEach((value, key) => {
      let input = document.createElement('input');
      input.type = 'hidden';
      input.name = key;
      input.value = value;
      form.appendChild(input);
    });
    // console.log(input.value);


    // Agregar el formulario al documento
    document.body.appendChild(form);

    // Enviar el formulario
    form.submit();

    // Eliminar el formulario después de enviarlo
    document.body.removeChild(form);
  }
}

</script>
