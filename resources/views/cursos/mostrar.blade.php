@extends('layouts.app')
@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h1 class="text-center text-muted mb-5">Cursos encontrados</h1>
                <div class="d-flex justify-content-end gap-2 mb-4">
                    @auth
                        <a href="{{ route('inicio') }}" class="btn btn-primary text-light align-bottom"><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-arrow-left align-middle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg> REGRESAR </a>
                    @else
                        <a href="{{ route('index') }}" class="btn btn-primary text-light align-bottom"><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-arrow-left align-middle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg> REGRESAR </a>
                    @endauth
                </div>
                {{-- Inicio creando Tarjetas de Cursos --}}
                <div class="row">
                    {{-- Foreach de los cursos que se mostraran, usamos unique para que no muestre cursos duplicados --}}
                    @foreach ($cursos->unique('id_curso') as $curso)
                        <div class="col-6 mb-5">
                            <table class="table table-bordered border-dark h-100 align-middle">
                                <tr>
                                    <td colspan="2" rowspan="2" class="col-6 fw-bolder align-middle">
                                        {{ $curso->curso->curso_nombre }}
                                    </td>
                                    <td colspan="2"><span class="fw-semibold">Area:</span>
                                        {{ isset($curso->area->area) ? $curso->area->area : 'No registrada' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><span class="fw-semibold">Ciclo:</span>
                                        {{ $curso->curso->ciclo }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        {{ $curso->curso->departamento }}</td>
                                    <td class="align-middle text-capitalize">
                                        {{ $curso->dia }}
                                    </td>
                                    {{-- Foreach horarios (consulta los horarios que tienen 2 horarios) --}}
                                    @foreach ($horarios as $horario)
                                    {{-- Verificamos si el id del curso se encuentra entre los que tienen 2 horarios --}}
                                        @if ($curso->id_curso == $horario['id_curso'])
                                        {{-- Verificamos que el dia del curso sea diferente a el dia del horario que tiene 2 horarios--}}
                                        {{-- Esto se hizo para que no muestre el horario que anteriormente mostramos desde curso --}}
                                            @if ($curso->dia != $horario['dia'])
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
                                        {{ isset($curso->area->sede) ? $curso->area->sede : 'No asignada' }}
                                    </td>
                                    <td>
                                        {{ date('H:i', strtotime($curso->hora_inicio)) . '-' . date('H:i', strtotime($curso->hora_final)) }}
                                    </td>
                                    {{-- Foreach horarios para las horas --}}
                                    @foreach ($horarios as $horario)
                                    {{-- Validamos que el id del curso sea igual al id del curso de los que tienen 2 horarios  --}}
                                        @if ($curso->id_curso == $horario['id_curso'])
                                        {{-- Si el dia del curso es diferente al dia que tiene 2 horarios muestra la celda --}}
                                        {{-- Esto se hizo teniendo en cuenta que no existen un curso con el mismo dia en caso de tener dos horarios --}}
                                            @if ($curso->dia != $horario['dia'])
                                                <td>
                                                    {{ date('H:i', strtotime($horario['hora_inicio'])) . '-' . date('H:i', strtotime($horario['hora_final'])) }}
                                                </td>
                                            @endif
                                        @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    @auth
                                    <td colspan="4">
                                            {{-- <div class="row align-items-center justify-content-center my-3"> --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <a href="{{ route('editar', $curso->curso->id) }}" class="text-reset p-5">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></a>
                                            {{-- </div> --}}
                                        </td>
                                        @endauth
                                </tr>
                            </table>
                        </div>
                    @endforeach
                </div>
                {{-- Final creando Tarjetas de Cursos --}}
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{-- Regresamos los filtros para que se mantenga la misma consulta
                        anterior solo cambiendo de pagina. --}}
                    {!! $cursos->appends($filtros) !!}
                </ul>
            </nav>
        </div>
    @endsection
