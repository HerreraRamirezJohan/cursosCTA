@extends('layouts.app')
@section('content')

{{-- @dd(Auth::user()) --}}
<div class="container">

    @foreach (['modificado', 'coincide', 'invalidpass', 'passwordChanged', 'noCoincide'] as $sessionKey)
            @if (session($sessionKey))
                <div class="alert alert-danger"
                    role="alert" id="alerta">
                    {{ session($sessionKey) }}
                </div>
            @endif
        @endforeach

    <div class="d-flex">
        <h2 class="text-center w-25">
             Editar Perfil
        </h2>
        <form action="{{route('updateProfile', Auth::user() )}}" method="POST" class="w-50 flex-grow-1">
            @csrf
            @method('PUT')
            <div class="row row-cols-lg-auto align-items-center justify-content-center mt-0 flex-column" style="gap:1rem 2rem">
            
                <label for="name">Nombre:</label>
                <input class= "form-control w-25" type="text" name="name" id="name" value="{{Auth::user()->name}}">
            
                <label for="email">Correo electrónico:</label>
                <input class="form-control w-25" type="email" name="email" id="email" value="{{Auth::user()->email}}">
                
            </div>
            <div class="text-center my-3 px-4">
                <button class="btn btn-primary w-25" type="submit">Enviar</button>
            </div>
        </form>
    </div>

    <div class="d-flex mt-5">
        <h2 class="text-center w-25 ">
            Restablecer Contraseña
        </h2>
        <form action="{{route('changePassword', Auth::user() )}}" method="POST" class="w-50 flex-grow-1">
            @csrf
            @method('PUT')
            <div class="row row-cols-lg-auto align-items-center justify-content-center mt-0 flex-column" style="gap:1rem 2rem">
                    <label for="oldpass">Contraseña Actual:</label>
                    <input class="form-control w-25" name="oldPassword" type="password">

                    <label for="oldpass">Nueva Contraseña:</label>
                    <input class="form-control w-25" name="newPassword" type="password" placeholder="[A-Z], [0-9], [#*&-], [Min 8]">

                    <label for="oldpass">Confirmar Contraseña:</label>
                    <input class="form-control w-25" name="confirmPassword" type="password" placeholder="[A-Z], [0-9], [#*&-], [Min 8]">
            </div>
            <div class="text-center my-3 px-4">
                <button class="btn btn-primary w-25" type="submit">Enviar</button>
            </div>
        </form>
    </div>
</div>

@endsection