@extends('layouts.app')

@section('content')
    <div class="container text-center">
        {{-- @php
            $countAreas = count($areasHoras);
        @endphp --}}

        <div class="col-md-12 mx-auto mb-5">
            <h1 class="text-center fw-normal mb-2">Resultados de la búsqueda: </h1>
            {{-- <h5 class="text-muted">Se encontraron <span class="fw-semibold">{{$countAreas}}</span> áreas disponibles el día <span class="fw-semibold"> {{$diaRequest}}</span> a partir de las  <span class="fw-semibold">{{$horaRequest}}</span> horas.</h5> --}}

        </div>

        <table id="tablaResultados" class="display responsive dataTable dtr-inline collapsed text-start" width="100%">
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Día</th>
                    <th>Horarios disponibles</th>

                    {{-- <th>Horarios disponibles</th> --}}
                    {{-- <th>Horarios NO disponibles</th> --}}
                    {{-- <th>Acciones</th> --}}
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($areasHoras as $idArea => $horasPorDia)
                            <tr>
                                <td>{{ $horasPorDia['area'] }}</td>
                                <td>{{ $horasPorDia['dia'] }}</td>
                                <td>{{ $horasPorDia['horas'] }}</td>
                            </tr>
                @endforeach --}}
                            {{-- @dd($horariosDisponibles) --}}
                @foreach ($horariosDisponibles as $idArea => $horasPorDia)
                <tr>
                    <td>{{ $horasPorDia->area->area }}</td>
                    <td>{{ $horasPorDia['dia'] }}</td>
                    <td>Disponible</td>
                </tr>
    @endforeach
            </tbody>
        </table>

    </div>
@endsection
