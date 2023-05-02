@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h1 class="text-center text-muted mb-5">Crear curso</h1>
                <div class="col-md-5 mx-auto">
                    <form action="{{ route('guardar') }}" method="post">
                        @csrf
                        @include('cursos.form')
                        <button type="submit" class="btn btn-primary">Agregar</button>
                        <button type="submit" class="btn btn-danger">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
