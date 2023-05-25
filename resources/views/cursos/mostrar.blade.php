@extends('layouts.app')
@section('content')
    <div class="container text-center">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-danger align-items-center text-center mt-3">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('cursoModificado'))
                <div class="alert alert-success align-items-center text-center mt-3">
                    {{ session('cursoModificado') }}
                </div>
            @endif
            <div class="col-md-12 mx-auto">
                <h1 class="text-center fw-normal mb-2">Resultados de la busqueda: </h1>
                @php
                    // dd($cursos->total());
                    $totalCursos = $cursos->total();
                    // dd($totalCursos);
                    $mensaje = $totalCursos == 1 ? '1 curso encontrado' : ($totalCursos == 0 ? 'No se encontraron cursos.' : "$totalCursos cursos encontrados");
                @endphp

                <h4 class="text-muted">{{ $mensaje }}</h4>



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
                                        {{ $curso->curso->departamento }}
                                    </td>
                                    <td class="align-middle text-capitalize">
                                        {{ $curso->dia }}
                                    </td>
                                    {{-- Foreach horarios (consulta los horarios que tienen 2 horarios) --}}
                                    @foreach ($horarios as $horario)
                                        {{-- Verificamos si el id del curso se encuentra entre los que tienen 2 horarios --}}
                                        @if ($curso->id_curso == $horario['id_curso'])
                                            {{-- Verificamos que el dia del curso sea diferente a el dia del horario que tiene 2 horarios --}}
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
                                        <td colspan="2" style="border-style: none none none solid;" class="fw-semibold">

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                </svg>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ...
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Understood</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            Opciones de Curso:
                                        </td>
                                        <td colspan="2" style="border-style:none solid none none;">
                                            <div class="d-flex">
                                                {{-- Boton editar --}}
                                                <div class="d-flex w-50 justify-content-center align-items-center">
                                                    <a href="{{ route('editar', $curso->curso->id) }}"
                                                        class="text-decoration-none d-flex btn btn-outline-dark">
                                                        <p class="m-0 pe-3 ">Editar</p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
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
                                                        onclick="deleteConfirm('{{ route('eliminar', $curso->curso->id) }}')">
                                                        <p class="m-0 pe-3">Eliminar</p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                            <path
                                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
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
        <script>
            function deleteConfirm(url) {
                Swal.fire({
                    title: '¿Estás seguro de eliminar el curso?',
                    text: "Esta acción no podrá ser revertida",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Curso eliminado correctamente',
                            '',
                            'success'
                        ).then(() => {
                            window.location.href = url; // Redirige a la URL de eliminación
                        });
                    }
                });
            }
        </script>
    @endsection
