@extends('layouts.app')
@section('content')
    @php
        $horarioErrors = collect(session('errorsHorario'));
    @endphp
    <div class="container">
        @if (session('alert'))
            <div class="alert alert-danger">
                {{ session('alert') }}
            </div>
        @endif
        @if (session('msgSuccess'))
            <div class="alert alert-success">
                {{ session('msgSuccess') }}
            </div>
        @endif

        <div class="card text-center">
            <div class="card-header">
                Cursos y horarios
            </div>
            <div class="card-body">
                <h5 class="card-title">Importación de cursos</h5>
                <p class="card-text mb-0">Selecciona tu archivo excel, digita el ciclo correspondiente y luego presiona el
                    botón 'Enviar'.</p>
                <p>El proceso puede demorar, espere un momento.</p>
                {{-- <p class="card-text">Presiona solo una vez el botón de "Cargar horarios" y espera hasta que salga la alerta de éxito.</p> --}}
                {{-- <form action="{{route('importSeeder')}}" method="post" id="importSeeder"> --}}
                <form method="POST" action="{{ route('process.api') }}" enctype="multipart/form-data" onsubmit=importarHorarios(event) id="importCursos">
                    @csrf
                    <div class="row row-cols-lg-auto align-items-start justify-content-center mt-4 d-flex"
                        style="gap:1rem 2rem">
                        <div>
                            <label for="fileExcel">Archivo Excel</label>
                            <input class="form-control" type="file" id="fileExcel" name="fileExcel" accept=".xlsx, .xls"
                                required>
                            @if ($errors->has('fileExcel'))
                                <div class="mt-2 alert alert-danger" role="alert">
                                    {{ $errors->first('fileExcel') }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="ciclo">Ciclo del Archivo</label>
                            <input class="form-control" type="text" name="ciclo" id="ciclo" value="{{old('ciclo')}}" required>
                            @if (session('errorsHorario'))
                                @if (isset($horarioErrors['ciclo']))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $horarioErrors['ciclo'] }}
                                    </div>
                                @endif
                            @endif
                            @if ($errors->has('ciclo'))
                                <div class="mt-2 alert alert-danger" role="alert">
                                    {{ $errors->first('ciclo') }}
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 align-self">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                    @if (session()->has('coleccion'))
                        @php
                            // $coleccion = collect(session('coleccion'));
                            // $areasReg = explode(',', session('coleccion')['areasRegistradas']);
                            $areasOcup = explode(',', session('coleccion')['areasOcupadas']);
                            $caracteresNoDeseados = ['[', ']', "\""];
                        @endphp

                        {{-- <div>
                        @foreach ($areasReg as $item)
                            {{ str_replace($caracteresNoDeseados, '', $item) }} -
                        @endforeach
                    </div>
                    <br> --}}
                        <div class="mt-4">
                            <h5 class="text-center">Áreas que no fueron importadas</h5>
                        </div>
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
