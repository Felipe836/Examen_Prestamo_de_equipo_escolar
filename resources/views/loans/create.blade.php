@extends('layouts.app')

@section('content')
<div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
    <a href="{{ route('loans.create') }}" class="btn btn-primary">Inventario / Pedir Equipo</a>
    <a href="{{ route('loans.status') }}" class="btn btn-secondary">Ver Estado</a>
</div>

<div class="card-section" style="margin-bottom: 2rem;">
    <h2>Equipos Disponibles en Inventario</h2>
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Equipo</th>
                    <th>Cantidad Disponible</th>
                    <th>Especificaciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipments as $eq)
                    <tr>
                        <td><strong>{{ $eq->name }}</strong> ({{ $eq->category->name }})</td>
                        <td>{{ $eq->available_quantity }}</td>
                        <td>{{ $eq->specifications ?? 'Sin especificaciones' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center;">No hay equipos disponibles en este momento.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card-section">
    <h2>Solicitar Préstamo</h2>
    <form action="{{ route('loans.store') }}" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Día de Entrega</label>
                <input type="date" name="date_entrega" class="form-control" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label>Día de Devolución</label>
                <input type="date" name="date_final" class="form-control" min="{{ date('Y-m-d') }}" required>
            </div>
        </div>

        <h3 style="margin: 1rem 0 0.5rem 0; color: var(--dusty-grape);">Equipos Solicitados</h3>
        <div id="equipment-rows">
            <div class="equipment-row" style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1rem;">
                <div style="flex: 2;">
                    <label>Equipo</label>
                    <select name="equipment_ids[]" class="form-control" required>
                        @foreach($equipments as $eq)
                            <option value="{{ $eq->id }}">{{ $eq->name }} ({{ $eq->available_quantity }} disponibles)</option>
                        @endforeach
                    </select>
                </div>
                <div style="flex: 1;">
                    <label>Cantidad</label>
                    <input type="number" name="quantities[]" class="form-control" value="1" min="1" required>
                </div>
            </div>
        </div>

        <button type="button" id="add-equipment-row" class="btn btn-secondary btn-sm" style="margin-bottom: 1.5rem;">+ Agregar Otro Equipo</button>

        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary btn-lg">Solicitar Préstamo</button>
        </div>
    </form>
</div>
@endsection