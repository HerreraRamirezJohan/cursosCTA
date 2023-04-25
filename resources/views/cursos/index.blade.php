@extends('layouts.app')

@section('content')
    

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>{{ __('Cursos') }}</h1>
                    </div>
    
                    <div class="card-body">
                        @include('cursos.filters_bar')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection