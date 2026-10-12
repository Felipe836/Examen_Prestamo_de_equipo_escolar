<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrestaHard - Control y Préstamo de Equipos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="guest-body">
    <header class="fixed-header">
        <a href="{{ route('landing') }}" class="brand-logo">
            <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M4 6h16v10H4zM20 18H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2zm-8 1h4v2h-4z"/></svg>
            PrestaHard
        </a>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('landing') }}#acerca">Acerca de nosotros</a></li>
                <li><a href="{{ route('landing') }}#equipos">Equipos</a></li>
                <li><a href="{{ route('landing') }}#reglas">Reglas de préstamos</a></li>
                <li><a href="{{ route('landing') }}#contactos">Contactos</a></li>
            </ul>
        </nav>
        <div class="header-actions">
            <button id="theme-toggle" class="btn btn-secondary btn-sm" aria-label="Cambiar Tema">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M12 3a9 9 0 1 0 9 9c0-.46-.04-.92-.1-1.36a5.389 5.389 0 0 1-4.4 2.26 5.403 5.403 0 0 1-5.4-5.4c0-1.81.89-3.42 2.26-4.4C12.92 3.04 12.46 3 12 3z"/></svg>
            </button>
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn btn-accent">Registrarse</a>
        </div>
    </header>

    <main class="guest-main">
        @yield('content')
    </main>

    <footer class="landing-footer">
        <div class="footer-container">
            <div class="footer-brand">
                <div class="brand-logo">
                    <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M4 6h16v10H4zM20 18H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2zm-8 1h4v2h-4z"/></svg>
                    PrestaHard
                </div>
                <p>Gestión inteligente y préstamos ágiles de hardware tecnológico empresarial e institucional.</p>
            </div>
            
            <div class="footer-links">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="#acerca">Acerca de nosotros</a></li>
                    <li><a href="#equipos">Catálogo disponible</a></li>
                    <li><a href="#reglas">Reglas de préstamos</a></li>
                    <li><a href="#contactos">Contacto directo</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4>Contacto Oficial</h4>
                <p>
                    <svg class="icon-sm" viewBox="0 0 24 24"><path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    +52 555-123-4567
                </p>
                <p>
                    <svg class="icon-sm" viewBox="0 0 24 24"><path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    empresa@gmail.com
                </p>
                <p>
                    <svg class="icon-sm" viewBox="0 0 24 24"><path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    oficialempresa@gmail.com
                </p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} PrestaHard. Todos los derechos reservados. Control interno de inventario y préstamos.</p>
        </div>
    </footer>
</body>
</html>