@extends('layouts.app')

@section('content')
<h1 style="margin-bottom: 1.5rem;">Administrar Equipos e Inventario</h1>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem; align-items: start;">
    <div>
        <div class="card-section" style="margin-bottom: 1.5rem;">
            <h2>Agregar Categoría</h2>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Categoría</label>
                    <input type="text" name="name" class="form-control" required placeholder="Ej. Laptops, Routers">
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <input type="text" name="description" class="form-control" placeholder="Opcional">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">Guardar Categoría</button>
            </form>
        </div>

        <div class="card-section">
            <h2>Registrar Nuevo Equipo</h2>
            <form action="{{ route('equipment.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Categoría</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Seleccionar Categoría</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Equipo</label>
                    <input type="text" name="name" class="form-control" required placeholder="Ej. Dell Latitude 3420">
                </div>
                <div class="form-group">
                    <label>Cantidad Disponible en Inventario</label>
                    <input type="number" name="total_quantity" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label>Especificaciones</label>
                    <textarea name="specifications" class="form-control" rows="2" placeholder="RAM, Procesador, Serie..."></textarea>
                </div>
                <button type="submit" class="btn btn-accent" style="width:100%;">Agregar Equipo</button>
            </form>
        </div>
    </div>

    <div class="card-section">
        <h2>Inventario Registrado</h2>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Equipo</th>
                        <th>Cantidad Disponible</th>
                        <th>Especificaciones</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($equipments as $item)
                        <tr>
                            <td>{{ $item->category->name }}</td>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>{{ $item->available_quantity }} / {{ $item->total_quantity }}</td>
                            <td>{{ $item->specifications ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('equipment.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar equipo?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No existen equipos en el inventario.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection