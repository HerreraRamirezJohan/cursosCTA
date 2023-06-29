<div class="col-12 col-lg-6 mb-5">
{{-- <div class="h-100 table-responsive-sm"> --}}
    {{-- @dd($item->hora_inicio,$item->hora_final ) --}}
    <table class="table table-bordered border-dark align-middle h-100">
        <tr>
            <td colspan="2" rowspan="2" class="col-6 fw-bolder align-middle">
                {{ $item['curso']->curso_nombre }}
            </td>
            <td colspan="2"><span class="fw-semibold">Área:</span>
                {{ isset($item['area']->area) ? $item['area']->area : 'No registrada' }}</td>
        </tr>
        <tr>
            <td colspan="2"><span class="fw-semibold">Ciclo:</span>
                {{ $item['curso']->ciclo }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                {{ $item['curso']->departamento }}
            </td>
            <td class="align-middle text-capitalize">
                {{ $item->dia }}
            </td>
            {{-- Foreach horarios (consulta los horarios que tienen 2 horarios) --}}
            @foreach ($horarios as $horario)
            {{-- @dd($horario) --}}
            {{-- Validamos que de los horarios que trajo solo muestre los activos--}}
            {{-- Verificamos si el id del curso se encuentra entre los que tienen 2 horarios --}}
            @if ($item->id_curso == $horario['id_curso'])
                {{-- Verificamos que el dia del curso sea diferente a el dia del horario que tiene 2 horarios --}}
                {{-- Esto se hizo para que no muestre el horario que anteriormente mostramos desde curso --}}
                @if ($item->dia != $horario['dia'])
                <td class="align-middle text-capitalize">
                    {{-- Mostramos el dia que falta mostrar --}}
                    {{ $horario['dia'] }}
                </td>
                @endif
            @endif
            @endforeach
        </tr>
        <tr>
            <td colspan="2"><span class="fw-semibold">Sede:</span>
                {{ isset($item['area']->sede) ? $item['area']->sede : 'No asignada' }}
            </td>
            <td>
            {{-- @php
                $horas = $cursos[1]; // Obtén el arreglo de horas
                sort($horas); // Ordena el arreglo de forma ascendente
                $hora_minima = sprintf('%02d', $horas[0]); // Obtiene la hora mínima
                $hora_maxima = sprintf('%02d',end($horas)); // Obtiene la hora máxima
            @endphp --}}
                {{-- {{ $hora_minima . '-' . $hora_maxima }} --}}
                {{ $item->hora_inicio . '-' . $item->hora_final }}

            </td>
            {{-- Foreach horarios para las horas --}}
            {{-- @dd($horarios) --}}
            {{-- @foreach ($horarios as $horario) --}}
            {{-- Validamos que de los horarios que trajo solo muestre los activos--}}
                {{-- Validamos que el id del curso sea igual al id del curso de los que tienen 2 horarios  --}}
                {{-- @if ($item->id_curso == $horario['id_curso']) --}}
                    {{-- Si el dia del curso es diferente al dia que tiene 2 horarios muestra la celda --}}
                    {{-- Esto se hizo teniendo en cuenta que no existen un curso con el mismo dia en caso de tener dos horarios --}}
                    {{-- @if ($item->dia != $horario['dia'])
                    <td>
                        {{ date('H:i', strtotime($horario['hora_inicio'])) . '-' . date('H:i', strtotime($horario['hora_final'])) }}
                    </td>
                    @endif
                @endif
            @endforeach --}}
        </tr>
        <tr>
            @auth
            @if ($lastCiclo == $item['curso']->ciclo)
            <td colspan="2" style="border-style: none none none solid;" class="fw-semibold">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                        data-bs-target="#modal{{ $item->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                            fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                            <path
                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                    </button>

                    @include('cursos.layouts.cursosModal')
                     <span class="d-none d-sm-inline">Opciones de Curso:</span>
                </td>
                <td colspan="2" style="border-style:none solid none none;">
                    <div class="d-flex">
                        {{-- Boton editar --}}
                        <div class="d-flex w-50 justify-content-center align-items-center">
                            <a href="{{ route('editar', $item['curso']->id) }}"
                                class="text-decoration-none d-flex btn btn-outline-dark">
                                <p class="m-0 pe-3 d-none d-sm-table-cell">Editar</p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    fill="currentColor" class="bi bi-pencil-square"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
                        </div>
                        {{-- Boton eliminar --}}
                        <div class="d-flex w-50 justify-content-center align-items-center">
                            <a id="eliminar" class="text-decoration-none d-flex btn btn-outline-dark"
                                onclick="deleteConfirm('{{ route('eliminar', $item['curso']->id) }}')">
                                <p class="m-0 pe-3 d-none d-sm-table-cell">Eliminar</p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </td>
                @else
                    @include('cursos.layouts.optionsCard')
                @endif
            @endauth
        </tr>
    </table>
{{-- </div> --}}
</div>