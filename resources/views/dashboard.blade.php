@extends('layouts.app')

@section('content')
<h1 style="margin-bottom: 1.5rem;">Dashboard general - PrestaHard</h1>

<div class="kpi-grid">
    @if(Auth::user()->isEncargado())
        <div class="kpi-card">
            <div class="kpi-icon">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M4 6h16v10H4zM20 18H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2z"/></svg>
            </div>
            <div>
                <div class="kpi-value">{{ $kpiTotalEquipos }}</div>
                <div class="kpi-label">Total Equipos en Inventario</div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
            </div>
            <div>
                <div class="kpi-value">{{ $kpiEquiposPrestados }}</div>
                <div class="kpi-label">Equipos Actuales Prestados</div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
            </div>
            <div>
                <div class="kpi-value">{{ $kpiSolicitudesPendientes }}</div>
                <div class="kpi-label">Solicitudes Pendientes</div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <div>
                <div class="kpi-value">{{ $kpiIncidentesPorRevisar }}</div>
                <div class="kpi-label">Incidentes por Revisar</div>
            </div>
        </div>
    @else
        <div class="kpi-card">
            <div class="kpi-icon">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/></svg>
            </div>
            <div>
                <div class="kpi-value">{{ $kpiMisSolicitudes }}</div>
                <div class="kpi-label">Mis Solicitudes Totales</div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
            </div>
            <div>
                <div class="kpi-value">{{ $kpiPrestamosActivos }}</div>
                <div class="kpi-label">Préstamos Activos</div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon">
                <svg class="icon" viewBox="0 0 24 24"><path fill="currentColor" d="M4 6h16v10H4z"/></svg>
            </div>
            <div>
                <div class="kpi-value">{{ $kpiEquiposDisponibles }}</div>
                <div class="kpi-label">Equipos Disponibles Globales</div>
            </div>
        </div>
    @endif
</div>

<div class="card-section">
    <h2>Últimos Préstamos / Actividad</h2>
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Solicitante</th>
                    <th>Fecha Entrega</th>
                    <th>Fecha Devolución</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLoans as $loan)
                    <tr>
                        <td><strong>{{ $loan->folio }}</strong></td>
                        <td>{{ $loan->user->name ?? Auth::user()->name }}</td>
                        <td>{{ $loan->date_entrega }}</td>
                        <td>{{ $loan->date_final }}</td>
                        <td>
                            <span class="badge badge-{{ $loan->status }}">{{ $loan->status }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">No hay préstamos registrados aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection