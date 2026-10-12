@extends('layouts.guest')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <h2 style="text-align: center; margin-bottom: 1.5rem; color: var(--dusty-grape);">Registrar Usuario</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre Completo</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required minlength="6">
            </div>

            <div style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Acceder</button>
            </div>
        </form>
    </div>
</div>
@endsection