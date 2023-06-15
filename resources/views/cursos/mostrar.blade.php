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
        
        @endsection
