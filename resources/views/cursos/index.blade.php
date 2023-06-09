@extends('layouts.app')

@section('content')
    @if (Session::has('msg'))
        <p style="display:block; background-color:red; color:white; fontsize:25px; margin:20px; padding:20px;">
            {{ Session::get('msg') }}
        </p>
    @endif

    <div class="container">
        @foreach (['cursoCreado', 'cursoModificado', 'segundoHorario'] as $sessionKey)
            @if (session($sessionKey))
                <div class="alert alert-{{ $sessionKey == 'cursoCreado' || $sessionKey == 'cursoModificado' ? 'success' : 'danger' }}"
                    role="alert" id="alerta">
                    {{ session($sessionKey) }}
                </div>
            @endif
        @endforeach
        {{-- <div class="row justify-content-center"> --}}
        <div>
            {{-- <div class="col-md-8"> --}}
            <div class="card g-0">
                <div class="card-header text-center">
                    <h1>{{ __('Cursos') }}</h1>
                </div>
                {{-- @auth  
                    <div class="row mt-4 mx-2">
                        <div class="col-12 text-end">
                            <a href="{{ route('importExcel') }}" class="btn btn-success text-light">Importar</a>
                        </div>
                    </div>
                @endauth --}}
                @auth
                    <div class="row mt-4 mx-2">
                        <div class="col-12 text-end">
                            <a href="{{ route('crear') }}" class="btn btn-success text-light">AGREGAR CURSO</a>
                        </div>
                    </div>
                @endauth
                <div class="card-body pb-0">
                    @include('cursos.filters_bar')
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection


<script>
  // Aseguramos de que el script se ejecute después de cargar el botón en el DOM
  window.addEventListener("DOMContentLoaded", function () {
    let limpiarBtn = document.getElementById("limpiarBtn");
    // console.log(limpiarBtn); // Verificar si se encuentra el elemento
    limpiarBtn.addEventListener("click", reiniciarForm);
    function reiniciarForm() {
      let formulario = document.getElementById("form");
      formulario.reset();
    }
  });
</script>
