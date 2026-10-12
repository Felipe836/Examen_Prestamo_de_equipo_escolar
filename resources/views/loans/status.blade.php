@extends('layouts.app')

@section('content')
<div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
    <a href="{{ route('loans.create') }}" class="btn btn-secondary">Inventario / Pedir Equipo</a>
    <a href="{{ route('loans.status') }}" class="btn btn-primary">Ver Estado</a>
</div>

<div class="card-section">
    <h2>Estado de Mis Préstamos</h2>
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Folio de Préstamo</th>
                    <th>Fecha de Entrega</th>
                    <th>Fecha de Devolución</th>
                    <th>Estado</th>
                    <th>Equipos Solicitados</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td><strong>{{ $loan->folio }}</strong></td>
                        <td>{{ $loan->date_entrega }}</td>
                        <td>{{ $loan->date_final }}</td>
                        <td>
                            <span class="badge badge-{{ $loan->status }}">{{ $loan->status }}</span>
                        </td>
                        <td>
                            <ul>
                                @foreach($loan->items as $item)
                                    <li>{{ $item->equipment->name }} (Cant: {{ $item->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">No has realizado solicitudes de préstamos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection