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
                <h1 class="text-center fw-normal mb-2">Resultados de la búsqueda: </h1>
                @php
                    $route = auth()->check() ? route('inicio') : route('index');
                    $totalCursos = $cursos->count();
                    $mensaje = $totalCursos == 1 ? '1 curso encontrado' : ($totalCursos == 0 ? 'No se encontraron cursos.' : "$totalCursos cursos encontrados");
                @endphp

                <h4 class="text-muted">{{ $mensaje }}</h4>
                <div class="d-flex justify-content-end gap-2 mb-4">
                    <a href="{{ $route }}" class="btn btn-primary text-light align-bottom"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-arrow-left align-middle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg> REGRESAR </a>
                </div>
                {{-- <form action="{{ route('subfiltros') }}" method="POST">
                    @csrf
                    <div class="row row-cols-lg-auto align-items-center justify-content-center mt-0 mb-4"
                        style="gap:1rem 2rem">
                        <div>
                            <label for="dia_subfiltro">Día</label>
                            <select id="dia_subfiltro" class="form-select" name="dia_subfiltro">
                                <option selected value="">Todos</option>
                                <option value="lunes">Lunes</option>
                                <option value="martes">Martes</option>
                                <option value="miércoles">Miércoles</option>
                                <option value="jueves">Jueves</option>
                                <option value="viernes">Viernes</option>
                                <option value="sábado">Sábado</option>
                            </select>
                        </div>
                        <div>
                            <label for="hora_inicio_subfiltro" class="validationDefault04">Hora de inicio</label>
                            <input id="hora_inicio_subfiltro" type="time" name="hora_inicio_subfiltro"
                                class="form-control" min="07:00" max="21:00">
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                            <label for="busqueda">Búsqueda</label>
                            <input type="text" class="form-control" name="busqueda" id="busqueda">
                        </div>

                        <div class="align-self-end">
                            <button class="btn btn-success" type="submit">Buscar</button>
                        </div>

                    </div>
                </form> --}}
                {{-- Inicio creando Tarjetas de Cursos --}}
                <div class="row shadow">
                    {{-- Foreach de los cursos que se mostraran, usamos unique para que no muestre cursos duplicados --}}
                    {{-- @foreach ($cursos->unique('id_curso') as $key => $item) --}}
                    @include('cursos.layouts.cursosMostrarDT')
                    {{-- @endforeach --}}
                </div>
                {{-- Final creando Tarjetas de Cursos --}}
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{-- Regresamos los filtros para que se mantenga la misma consulta
                        anterior solo cambiendo de pagina. --}}
                    {{-- {!! $cursos->appends($filtros) !!} --}}
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
            $(document).ready(function() {
                $('#miTabla').DataTable({
                    order: [],
                    searching: true,
                    // Resto de las configuraciones y opciones de DataTables
                });
            });

            function sortByDays() {
                var table = document.querySelector('table');
                var tbody = table.querySelector('tbody');
                var rows = Array.from(tbody.getElementsByTagName('tr'));

                rows.sort(function(a, b) {
                    var dayOrder = {
                        Lunes: 1,
                        Martes: 2,
                        Miercoles: 3,
                        Jueves: 4,
                        Viernes: 5
                    };

                    var dayA = a.cells[0].textContent.toLowerCase();
                    var dayB = b.cells[0].textContent.toLowerCase();

                    return dayOrder[dayA] - dayOrder[dayB];
                });

                rows.forEach(function(row) {
                    tbody.removeChild(row);
                });

                rows.forEach(function(row) {
                    tbody.appendChild(row);
                });
            }
        </script>
    @endsection
