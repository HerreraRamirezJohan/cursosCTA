@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h1 class="text-center text-muted mb-5">Cursos encontrados</h1>
                <div class="d-flex justify-content-end gap-2 mb-4">
                    <a href="{{ route('inicio') }}" class="btn btn-primary text-light align-bottom"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-arrow-left align-middle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg> REGRESAR </a>

                </div>

                <div class="row">
                    @foreach ($cursos as $curso)
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="div card-body">
                                    <h5 class="card-title text-center mb-3">
                                        {{ $curso->curso_nombre }}
                                    </h5>
                                    <p class="card-text text-muted"></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ $curso->departamento }}</li>
                                    <li class="list-group-item">{{ $curso->sede }}</li>
                                    <li class="list-group-item d-flex justify-content-around">
                                        <h5><span class="badge bg-primary">{{ $curso->ciclo }}</span></h5>
                                        <h5><span class="badge bg-success text-capitalize">{{ $curso->dia }}</span></h5>
                                        {{-- Utilizamos metodo data de PHP para obtener el formato de HH:MM::SS a solo HH:MM --}}
                                        <h5><span
                                                class="badge bg-danger">{{ date('H:i', strtotime($curso->hora_inicio)) . '-' . date('H:i', strtotime($curso->hora_final)) }}</span>
                                        </h5>
                                    </li>
                                </ul>
                                <div class="row align-items-center justify-content-center my-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <a href="{{route('editar', $curso->id)}}" class="text-reset"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></a>
                                </div>
                                {{-- <div class="card-body d-grid gap-2 col-10 mx-auto">
                                <a class="btn btn-primary text-light">Edit</a>
                            </div> --}}

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                {{-- {{$cursos->appends('ciclo' => $ciclo)->links()}} --}}
                {{-- {!! $cursos->appends(['ciclo' => $ciclo]) !!} --}}
                {!! $cursos->appends($filtros) !!}
            </ul>
        </nav>

    </div>
@endsection
