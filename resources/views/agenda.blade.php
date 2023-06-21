@extends('layouts.app')

@section('content')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <div class="container">
        <div class="table-responsive">
            <div class="row mt-1 mb-4">
                <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                    {{-- <div class="text-sm-start text-md-start text-lg-center">
                    <label for="area">Área</label>
                </div> --}}

                    <form action="{{ route('agenda') }}">
                        @csrf
                        <div class="d-flex gap-3 my-0">
                            <select id="area" class="form-select w-100 js-example-basic-single" name="edificio">
                                <option selected value="">Todos los edificios</option>
                                @foreach ($edificios->unique('edificio') as $item)
                                    @if ($item->edificio != '-')
                                        <option value="{{ $item->edificio }}">
                                            {{ $item->edificio }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                    <h1 class="text-center mt-3 mb-2">Lunes</h1>

                </div>
            </div>
            <div>
                {{-- @dd($resultados) --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach ($aulas as $aula)
                                <th class="fw-normal">{{ $aula->area }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (range(7, 21) as $hour)
                            <tr>
                                <td>{{ sprintf('%02d', $hour) }}:00</td>
                                @foreach ($aulas as $aula)
                                @php
                                $hourExists = null;
                                        foreach ($resultados as $key => $item) {
                                            foreach ($allNrc as $key2 => $nrc) {
                                                if ($aula->id == $item['id_area']) {
                                                    $hourExists = in_array($hour, $item['horas']);
                                                }
                                            }
                                        }
                                        
                                    @endphp
                                    <td style="background-color:{{ $hourExists ? '#0ddb44' : '#ff0033' }}"></td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        {{-- <div id="agenda">        </div> --}}
    </div>
@endsection
