@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('mostrarAreas')}}" method="post">
            @csrf
            <div class="d-flex w-50 justify-content-between gap-3 mb-4">
                {{-- <label for="estatus">Día</label> --}}
                <select id="estatus" class="form-select" name="dia">
                    <option selected disabled>Elegir</option>
                    <option value="lunes">Lunes</option>
                    <option value="martes">Martes</option>
                    <option value="miércoles">Miércoles</option>
                    <option value="jueves">Jueves</option>
                    <option value="viernes">Viernes</option>
                    <option value="sábado">Sábado</option>
                </select>

                <select id="hora" class="form-select" name="hora">
                    <option selected disabled>Elegir</option>
                    @for ($hour = 7; $hour <= 21; $hour++)
                        <option value="{{ $hour }}">{{ sprintf('%02d', $hour) }}:00</option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <table id="tablaAreas" class="display responsive dataTable dtr-inline collapsed text-start" width="100%">
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Horarios disponibles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($areas as $item)
                    <tr>
                        <td class="w-25">{{ isset($item->area) ? $item->area : 'No registrada' }}</td>
                        <td>{{ $item->disponibilidad != 0 ? $item->disponibilidad : 'Sin disponibilidad.' }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
