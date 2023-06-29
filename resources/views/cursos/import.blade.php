@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
        <div id="alert" class="alert alert-success align-items-center text-center mt-3">
            {{ session('success') }}
        </div>
    @endif
        <div class="card text-center">
            <div class="card-header">
                Horarios
            </div>
            <div class="card-body">
                <h5 class="card-title">Importación de horarios</h5>
                <p class="card-text">Presiona solo una vez el botón de "Cargar horarios" y espera hasta que salga la alerta de éxito.</p>
                <form action="{{route('importSeeder')}}" method="post" id="importSeeder">
                    @csrf
                    <button type="button" class="btn btn-primary" onclick="importarHorarios()" >Cargar horarios</button>
                </form>
            </div>
        </div>
    </div>
@endsection
