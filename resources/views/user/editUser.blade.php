@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        @foreach (['modificado', 'coincide', 'invalidpass', 'noCoincide'] as $sessionKey)
            @if (session($sessionKey))
                <div class="alert alert-danger" role="alert" id="alerta">
                    {{ session($sessionKey) }}
                </div>
            @endif
        @endforeach
        @if (session('passwordChanged'))
            <div class="alert alert-success" role="alert" id="alerta">
                {{ session('passwordChanged') }}
            </div>
        @endif
        <div class="row mb-4">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="px-4">
                    <h4>Información Personal</h4>
                    <p class="mt-1 text-sm text-gray-600">Actualiza el nombre y correo electrónico de tu cuenta.</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 mb-4">
                <div class="px-4 py-3 bg-white shadow-sm rounded-top">
                    <form action="{{ route('updateProfile', Auth::user()) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <!-- Name -->
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <label for="name">Nombre</label>
                                <input class="form-control" id="name" type="text" name="name"
                                    value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="row">
                            <!-- Email -->
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <label for="email">Correo electrónico</label>
                                <input class="form-control" id="email" type="text" name="email"
                                    value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                </div>
                <div class="px-4 py-2 bg-light shadow-sm text-right rounded-bottom d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark">Guardar</button>
                </div>
                </form>
            </div>
            <div class="d-none d-sm-block">
                <div class="py-8">
                    <div class="border-top border-gray-200"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="px-4">
                    <h4>Actualizar Contraseña</h4>
                    <p class="mt-1">
                        Mantenga una contraseña larga y segura.
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 mb-4">
                <div class="px-4 py-3 bg-white shadow-sm rounded-top">
                    <form action="{{ route('changePassword', Auth::user()) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <!-- Contraseña actual -->
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <label for="oldPassword">Contraseña actual</label>
                                <input class="form-control" name="oldPassword" id="oldPassword" type="password" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <!-- Nueva contraseña -->
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <label for="newPassword">Nueva contraseña</label>
                                <input class="form-control" name="newPassword" id="newPassword" type="password" required
                                    placeholder="[A-Z], [0-9], [#*&-], [Min 8]">
                            </div>
                        </div>
                        <div class="row">
                            <!-- Confirmar contraseña -->
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <label for="confirmPassword">Confirmar contraseña</label>
                                <input class="form-control" name="confirmPassword" id="confirmPassword" type="password"
                                    required placeholder="[A-Z], [0-9], [#*&-], [Min 8]">
                            </div>
                        </div>
                </div>
                <div class="px-4 py-2 bg-light text-right shadow-sm rounded-bottom d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark">Guardar</button>
                </div>
                </form>
            </div>

        </div>
    </div>
@endsection
