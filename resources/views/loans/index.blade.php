@extends('layouts.app')

@section('content')
<div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
    <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Administrar Equipos</a>
    <a href="{{ route('loans.index') }}" class="btn btn-primary">Solicitudes</a>
    <a href="{{ route('incidents.index') }}" class="btn btn-secondary">Incidentes</a>
</div>

<div class="card-section">
    <h2>Gestión de Solicitudes de Préstamo</h2>
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Folio de Préstamo</th>
                    <th>Solicitante</th>
                    <th>Fecha Entrega</th>
                    <th>Estado</th>
                    <th>Equipos Solicitados</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td><strong>{{ $loan->folio }}</strong></td>
                        <td>{{ $loan->user->name }}</td>
                        <td>{{ $loan->date_entrega }} a {{ $loan->date_final }}</td>
                        <td>
                            <span class="badge badge-{{ $loan->status }}">{{ $loan->status }}</span>
                        </td>
                        <td>
                            <ul style="margin-left: 1rem;">
                                @foreach($loan->items as $item)
                                    <li>{{ $item->equipment->name }} (Cant: {{ $item->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.3rem;">
                                @if($loan->status === 'pendiente')
                                    <form action="{{ route('loans.updateStatus', $loan->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="entregado">
                                        <button class="btn btn-accent btn-sm">Aprobar y Entregar</button>
                                    </form>

                                    <form action="{{ route('loans.updateStatus', $loan->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="denegado">
                                        <button class="btn btn-danger btn-sm">Denegar</button>
                                    </form>
                                @elseif($loan->status === 'entregado')
                                    <form action="{{ route('loans.updateStatus', $loan->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="devuelto">
                                        <button class="btn btn-primary btn-sm">Registrar Devolución</button>
                                    </form>
                                @else
                                    <span style="color: var(--text-muted); font-size: 0.85rem;">Procesado</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">No hay solicitudes registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection