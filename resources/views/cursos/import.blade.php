@extends('layouts.app')
@section('content')
    <div class="container">
        {{-- @if (!isset($colleccion['errores']))
        <div id="alert" class="alert alert-success align-items-center text-center mt-3">
            {{ $msgSuccess }}
        </div>
    @endif --}}
        <div class="card text-center">
            <div class="card-header">
                Cursos y horarios
            </div>
            <div class="card-body">
                <h5 class="card-title">Importación de cursos</h5>
                <p class="card-text">Selecciona tu archivo excel, digita el ciclo correspondiente y finalmente presiona el
                    botón 'Enviar'.</p>
                {{-- <p class="card-text">Presiona solo una vez el botón de "Cargar horarios" y espera hasta que salga la alerta de éxito.</p> --}}
                {{-- <form action="{{route('importSeeder')}}" method="post" id="importSeeder"> --}}
                <form method="POST" action="{{ route('process.api') }}" enctype="multipart/form-data" id="importCursos">
                    @csrf
                    <div class="row row-cols-lg-auto align-items-start justify-content-center mt-4 d-flex"
                        style="gap:1rem 2rem">
                        <div>
                            <label for="fileExcel">Archivo Excel</label>
                            <input class="form-control" type="file" id="fileExcel" name="fileExcel" accept=".xlsx, .xls"
                                required>
                        </div>
                        <div>
                            <label for="ciclo">Ciclo del Archivo</label>
                            <input class="form-control" type="text" name="ciclo" id="ciclo" required>
                        </div>
                        <div class="align-self-end">
                            <button type="button" class="btn btn-primary" onclick="importarHorarios()">Enviar</button>
                        </div>
                    </div>
                    @if (isset($coleccion))                        
                    @php
                        $areasReg = explode(',', $coleccion['areasRegistradas']);
                        $areasOcup = explode(',', $coleccion['areasOcupadas']);
                        $caracteresNoDeseados = ['[', ']', "\""];
                    @endphp

                    <div>
                        @foreach ($areasReg as $item)
                            {{ str_replace($caracteresNoDeseados, '', $item) }} -
                        @endforeach
                    </div>
                    <br>
                    <div>
                        @foreach ($areasOcup as $item)
                            {{ str_replace($caracteresNoDeseados, '', $item) }} -
                        @endforeach
                    </div>
                    @endif
                    {{-- <button type="button" class="btn btn-primary" onclick="importarHorarios()" >Cargar horarios</button> --}}
                    {{-- </form> --}}
            </div>
        </div>
    </div>
    {{-- @if (isset($coleccion))
        @dd($coleccion, $coleccion['errores'], explode(',', $coleccion['errores']))
    @endif --}}
@endsection
