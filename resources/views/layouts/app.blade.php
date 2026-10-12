<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrestaHard - Panel Interno</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="fixed-header">
        <div style="display:flex; align-items:center; gap:1rem;">
            <button id="mobile-menu-btn" class="btn btn-secondary btn-sm" style="display:none;">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
            </button>
            <a href="{{ route('dashboard') }}" class="brand-logo">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M4 6h16v10H4zM20 18H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2zm-8 1h4v2h-4z"/></svg>
                PrestaHard
            </a>
        </div>
        <div class="header-actions">
            <span style="font-weight:600;">{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</span>
            <button id="theme-toggle" class="btn btn-secondary btn-sm">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M12 3a9 9 0 1 0 9 9c0-.46-.04-.92-.1-1.36a5.389 5.389 0 0 1-4.4 2.26 5.403 5.403 0 0 1-5.4-5.4c0-1.81.89-3.42 2.26-4.4C12.92 3.04 12.46 3 12 3z"/></svg>
            </button>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Cerrar Sesión</button>
            </form>
        </div>
    </header>

    <div class="app-container">
        <aside class="sidebar">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8v-10h-8v10zm0-18v6h8V3h-8z"/></svg>
                Dashboard
            </a>

            @if(Auth::user()->isEncargado())
                <a href="{{ route('equipment.index') }}" class="{{ request()->routeIs('equipment.*') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M22 9V7h-2V5c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-2h2v-2h-2v-2h2v-2h-2V9h2zm-4 10H4V5h14v14z"/></svg>
                    Administrar Equipos
                </a>
                <a href="{{ route('loans.index') }}" class="{{ request()->routeIs('loans.index') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                    Solicitudes
                </a>
            @else
                <a href="{{ route('loans.create') }}" class="{{ request()->routeIs('loans.create') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    Pedir Equipo
                </a>
                <a href="{{ route('loans.status') }}" class="{{ request()->routeIs('loans.status') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    Ver Estado
                </a>
            @endif

            <a href="{{ route('incidents.index') }}" class="{{ request()->routeIs('incidents.*') ? 'active' : '' }}">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                Incidentes
            </a>
        </aside>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('info'))
                <div class="alert alert-pending">{{ session('info') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-left: 1.2rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>