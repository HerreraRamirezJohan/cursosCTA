@extends('layouts.app')

@section('content')
    @if (Session::has('msg'))
        <p style="display:block; background-color:red; color:white; fontsize:25px; margin:20px; padding:20px;">
            {{ Session::get('msg') }}
        </p>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header text-center">
                    <h1>{{ __('Cursos') }}</h1>
                </div>
                @auth
                    <div class="d-flex justify-content-end gap-2 mt-4 mx-3">
                        <a href="{{ route('crear') }}" class="btn btn-success text-light align-bottom"> AGREGAR CURSO </a>
                    </div>
                @endauth
                <div class="card-body">
                    @include('cursos.filters_bar')
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>
    <br><br>
@endsection
