@extends('layouts.app')

@section('content')
<h1 style="margin-bottom: 1.5rem;">Control e Incidentes de Equipos</h1>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem; align-items: start;">
    <div class="card-section">
        <h2>Reportar Nuevo Incidente</h2>
        <form action="{{ route('incidents.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Equipo Afectado</label>
                <select name="equipment_id" class="form-control" required>
                    @foreach($equipments as $eq)
                        <option value="{{ $eq->id }}">{{ $eq->name }}</option>
                    @endforeach
                </select>
            </div>

            @if(!Auth::user()->isEncargado())
                <div class="form-group">
                    <label>Préstamo Asociado (Opcional)</label>
                    <select name="loan_id" class="form-control">
                        <option value="">Ninguno</option>
                        @foreach($loans as $l)
                            <option value="{{ $l->id }}">{{ $l->folio }} - ({{ $l->date_entrega }})</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="form-group">
                <label>Daño Observado</label>
                <input type="text" name="damage" class="form-control" required placeholder="Ej. Pantalla estrellada, puerto roto">
            </div>

            <div class="form-group">
                <label>Especificaciones / Detalles</label>
                <textarea name="specifications" class="form-control" rows="3" placeholder="Describe brevemente lo sucedido..."></textarea>
            </div>

            <button type="submit" class="btn btn-danger" style="width:100%;">Enviar Reporte</button>
        </form>
    </div>

    <div class="card-section">
        <h2>Historial de Incidentes</h2>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Equipo</th>
                        <th>Daño</th>
                        <th>Especificaciones</th>
                        <th>Estado</th>
                        @if(Auth::user()->isEncargado())
                            <th>Acción</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($incidents as $inc)
                        <tr>
                            <td><strong>{{ $inc->equipment->name }}</strong></td>
                            <td>{{ $inc->damage }}</td>
                            <td>{{ $inc->specifications ?? 'N/A' }}</td>
                            <td>
                                <span class="badge badge-{{ $inc->status }}">{{ str_replace('_', ' ', $inc->status) }}</span>
                            </td>
                            @if(Auth::user()->isEncargado())
                                <td>
                                    @if($inc->status === 'por_revisar')
                                        <form action="{{ route('incidents.repair', $inc->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-accent btn-sm">Marcar Reparado</button>
                                        </form>
                                    @else
                                        <span style="color: var(--text-muted); font-size: 0.85rem;">Resuelto</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->isEncargado() ? 5 : 4 }}" style="text-align: center;">No hay incidentes reportados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection