@extends('layouts.guest')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <h2 style="text-align: center; margin-bottom: 1.5rem; color: var(--dusty-grape);">Inicio de Sesión</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <a href="{{ route('register') }}" class="btn btn-secondary" style="flex: 1;">Registrate</a>
                <button type="submit" class="btn btn-primary" style="flex: 1;">Acceder</button>
            </div>
        </form>
    </div>
</div>
@endsection