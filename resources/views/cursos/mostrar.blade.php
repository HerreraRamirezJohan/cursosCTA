@extends('layouts.app')
@section('content')
    <div class="container text-center">
        <div class="row">
            @if (session('success'))
                <div id="alert" class="alert alert-danger align-items-center text-center mt-3">
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
                    <a href="{{ $route }}" class="btn btn-secondary text-light align-bottom"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-arrow-left align-middle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg> REGRESAR </a>
                </div>
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

        <!-- Modal de la DataTable info-buscar -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> --}}
                    <div class="modal-body">
                        <img src="https://media.slidesgo.com/storage/226116/conversions/1-ideas-infographics-thumb.jpg" alt="" width="100%" height="100%">
                    </div>  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        
            <script>
                // setTimeout(function() {
                //     document.getElementById('alert').style.display = 'none';
                // }, 5000);

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
                // Abrir el modal cuando se hace clic en el botón
                $('#modalBtn').on('click', function() {
                    $('#myModal').modal('show');
                });

                $(document).ready(function() {
                    $('#miTabla').DataTable({
                        order: [],
                        responsive: true,
                        searching: true,
                        columnDefs: [{
                            targets: 2,
                            type: 'enum',
                            // orderDataType: 'enum',
                        }, {
                            targets: 4,
                            type: 'custom-area',
                            orderDataType: 'custom-area',
                        }],
                        language: {
                            search: '<button type="button" style="border:none; background-color:transparent" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg></button>Buscar:',
                            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json',
                        },
                    });

                    // Definir el tipo de ordenamiento personalizado para el enum de días
                    $.fn.dataTable.ext.type.order['enum-pre'] = function(data) {
                        let firstWord = data.match(/(\b\w+\b)/)[0]; //Exp. Regular para encontrar la primera palabra, con el 0 accede a la primera coincidencia
                        let daysOrder = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado']; //Orden deseado
                        return daysOrder.indexOf(
                            firstWord
                        ); //Busca el indice de la primera palabra, retorna el indice de acuerdo al arreglo de dias
                    };

                    // Ordenamiento personalizado de areas
                    $.fn.dataTable.ext.type.order['custom-area-pre'] = function(data) {
                        let regex =/(\S+)\s+(\d+)/; //Expresión regular(cadena de una o mas letras/caracteres, seguido de uno o mas espacios y seguido de uno o mas digitos)
                        let match = data.match(regex); //guarda los datos y devuelve un arreglo de coincidencias (match tendra la palabra y el numero)
                        let word = match && match[1]; //obtiene la primera palabra de las coincidencias,  si no coincide es null
                        let number = match && parseInt(match[2]); //Se obtiene el numero de coincidencias y lo pasa entero sino es null
                        // Si el numero es menor que 10 se le agrega un 0 antes
                        if (number < 10) {
                            number = '0' + number;
                        }
                        // Devolvemos un arreglo que contiene la primera palabra y el numero
                        return [word, number];
                    };
                });
            </script>
        @endsection
