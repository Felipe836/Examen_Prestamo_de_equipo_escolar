<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller {
    public function index() {
        $equipments = Equipment::with('category')->get();
        $categories = Category::all();
        return view('equipment.index', compact('equipments', 'categories'));
    }

    public function storeCategory(Request $request) {
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only('name', 'description'));

        return redirect()->back()->with('success', 'Categoría creada con éxito.');
    }

    public function storeEquipment(Request $request) {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'total_quantity' => 'required|integer|min:1',
            'specifications' => 'nullable|string',
        ]);

        Equipment::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'total_quantity' => $request->total_quantity,
            'available_quantity' => $request->total_quantity,
            'specifications' => $request->specifications,
        ]);

        return redirect()->back()->with('success', 'Equipo registrado con éxito en el inventario.');
    }

    public function updateEquipment(Request $request, $id) {
        $equipment = Equipment::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'total_quantity' => 'required|integer|min:0',
            'specifications' => 'nullable|string',
        ]);

        $diff = $request->total_quantity - $equipment->total_quantity;
        $newAvailable = $equipment->available_quantity + $diff;

        if ($newAvailable < 0) {
            return redirect()->back()->withErrors(['total_quantity' => 'No puedes reducir el inventario total por debajo de la cantidad actualmente en préstamo.']);
        }

        $equipment->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'total_quantity' => $request->total_quantity,
            'available_quantity' => $newAvailable,
            'specifications' => $request->specifications,
        ]);

        return redirect()->back()->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroyEquipment($id) {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();
        return redirect()->back()->with('success', 'Equipo eliminado del inventario.');
    }
}