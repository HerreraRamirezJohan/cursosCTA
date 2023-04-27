@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h1 class="text-center text-muted mb-5">Cursos encontrados</h1>
                <div class="d-grid gap-2 mb-4">
                    <a href="{{ route('inicio') }}" class="btn btn-primary text-light">Regresar</a>
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
                                    <li class="list-group-item">{{$curso->sede}}</li>
                                    <li class="list-group-item d-flex justify-content-around">
                                        <h5><span class="badge bg-primary">{{ $curso->ciclo }}</span></h5>
                                        <h5><span class="badge bg-success text-capitalize">{{ $curso->dia }}</span></h5>
                                        <h5><span class="badge bg-danger">{{ $curso->horario }}</span></h5>
                                    </li>
                                </ul>
                                {{-- <div class="card-body d-grid gap-2 col-10 mx-auto">
                                <a class="btn btn-primary text-light">Edit</a>
                            </div> --}}

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
