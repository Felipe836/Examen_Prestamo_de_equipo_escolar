@extends('layouts.guest')

@section('content')
<div class="landing-container">
    <!-- Hero Banner -->
    <section class="hero-section">
        <div class="hero-content">
            <span class="hero-badge">Plataforma de Control de Hardware</span>
            <h1 class="hero-title">Gestión y préstamos de equipos tecnológicos sin complicaciones</h1>
            <p class="hero-subtitle">Optimizamos la asignación y control de laptops, proyectores, monitores y accesorios con inventario en tiempo real y seguimiento detallado.</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Solicitar un Préstamo</a>
                <a href="#acerca" class="btn btn-secondary btn-lg">Conocer Más</a>
            </div>
        </div>
    </section>

    <!-- Sección: Acerca de Nosotros -->
    <section id="acerca" class="landing-section">
        <div class="section-header">
            <h2>Acerca de Nosotros</h2>
            <p>Conoce la misión y el alcance del sistema de control interno de PrestaHard.</p>
        </div>
        <div class="card-section feature-card-highlight">
            <div class="feature-icon-wrapper">
                <svg class="icon-lg" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
            </div>
            <div class="feature-text">
                <h3>¿Qué hace PrestaHard?</h3>
                <p>En <strong>PrestaHard</strong> nos especializamos en la gestión interna y control automatizado del préstamo de equipos tecnológicos. Eliminamos los cuellos de botella mediante un inventario sincronizado que impide autorizar solicitudes cuando no se cuenta con stock disponible en el almacén.</p>
            </div>
        </div>
    </section>

    <!-- Sección: Catálogo de Equipos -->
    <section id="equipos" class="landing-section">
        <div class="section-header">
            <h2>Equipos en Control</h2>
            <p>Hardware catalogado para préstamo y devolución asignado por nuestro encargado.</p>
        </div>
        <div class="equipment-grid">
            <div class="equipment-card">
                <div class="eq-icon">
                    <svg class="icon-lg" viewBox="0 0 24 24"><path fill="currentColor" d="M22 18V3H2v15H0v2h24v-2h-2zm-8 0h-4v-1h4v1zm6-3H4V5h16v10z"/></svg>
                </div>
                <h4>Laptops</h4>
                <p>Equipos portátiles para trabajo de cómputo intensivo e investigación.</p>
            </div>

            <div class="equipment-card">
                <div class="eq-icon">
                    <svg class="icon-lg" viewBox="0 0 24 24"><path fill="currentColor" d="M21 3H3c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h7l-2 3v1h8v-1l-2-3h7c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 13H3V5h18v11z"/></svg>
                </div>
                <h4>Monitores</h4>
                <p>Pantallas externas para estaciones multitarea de alta definición.</p>
            </div>

            <div class="equipment-card">
                <div class="eq-icon">
                    <svg class="icon-lg" viewBox="0 0 24 24"><path fill="currentColor" d="M19 18H5c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2v8c0 1.1-.9 2-2 2zM5 8v8h14V8H5zm2 2h3v4H7v-4zm5 0h5v1h-5v-1zm0 3h3v1h-3v-1z"/></svg>
                </div>
                <h4>Proyectores</h4>
                <p>Sistemas audiovisuales para presentaciones, salas y ponencias.</p>
            </div>

            <div class="equipment-card">
                <div class="eq-icon">
                    <svg class="icon-lg" viewBox="0 0 24 24"><path fill="currentColor" d="M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7z"/></svg>
                </div>
                <h4>Routers & Redes</h4>
                <p>Conectividad rápida y estable para entornos de trabajo temporales.</p>
            </div>

            <div class="equipment-card">
                <div class="eq-icon">
                    <svg class="icon-lg" viewBox="0 0 24 24"><path fill="currentColor" d="M13 2v8h8V2h-8zm6 6h-4V4h4v4zm-6 4v8h8v-8h-8zm6 6h-4v-4h4v4zM3 2v8h8V2H3zm6 6H5V4h4v4zm-6 4v8h8v-8H3zm6 6H5v-4h4v4z"/></svg>
                </div>
                <h4>Teclados y Mouses</h4>
                <p>Periféricos de entrada para la optimización y confort de trabajo.</p>
            </div>
        </div>
    </section>

    <!-- Sección: Reglas de Préstamos -->
    <section id="reglas" class="landing-section">
        <div class="section-header">
            <h2>Reglas de Préstamos</h2>
            <p>Lineamientos generales para el cuidado y la devolución justa de los equipos.</p>
        </div>
        <div class="rules-grid">
            <div class="rule-card">
                <div class="rule-number">01</div>
                <h4>Puntualidad en la Fecha</h4>
                <p>Los equipos deben ser entregados estrictamente en la fecha acordada registrada en la solicitud inicial.</p>
            </div>

            <div class="rule-card">
                <div class="rule-number">02</div>
                <h4>Revisión de Estado</h4>
                <p>Al momento del retorno, el encargado realizará una inspección física y técnica del hardware entregado.</p>
            </div>

            <div class="rule-card">
                <div class="rule-number">03</div>
                <h4>Reporte de Conflictos</h4>
                <p>Si existe daño, falla o conflicto con el equipo devuelto, se registrará inmediatamente un incidente en el sistema.</p>
            </div>
        </div>
    </section>

    <!-- Sección: Contactos -->
    <section id="contactos" class="landing-section">
        <div class="section-header">
            <h2>Medios de Contacto</h2>
            <p>Ponte en comunicación con nuestro encargado o administración central.</p>
        </div>
        <div class="contact-cards-wrapper">
            <div class="contact-card">
                <div class="contact-icon">
                    <svg class="icon-lg" viewBox="0 0 24 24"><path fill="currentColor" d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z"/></svg>
                </div>
                <div>
                    <h4>Celular / WhatsApp</h4>
                    <p>+52 555-123-4567</p>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-icon">
                    <svg class="icon-lg" viewBox="0 0 24 24"><path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                </div>
                <div>
                    <h4>Correo Electrónico</h4>
                    <p>empresa@gmail.com</p>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-icon">
                    <svg class="icon-lg" viewBox="0 0 24 24"><path fill="currentColor" d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                </div>
                <div>
                    <h4>Correo Oficial</h4>
                    <p>oficialempresa@gmail.com</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection