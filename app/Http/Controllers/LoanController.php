<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Loan;
use App\Models\LoanItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoanController extends Controller {
    // Vista para el solicitante
    public function create() {
        $equipments = Equipment::with('category')->where('available_quantity', '>', 0)->get();
        return view('loans.create', compact('equipments'));
    }

    public function store(Request $request) {
        $today = date('Y-m-d');

        $request->validate([
            'date_entrega' => "required|date|after_or_equal:{$today}",
            'date_final' => 'required|date|after_or_equal:date_entrega',
            'equipment_ids' => 'required|array|min:1',
            'equipment_ids.*' => 'required|exists:equipment,id',
            'quantities' => 'required|array|min:1',
            'quantities.*' => 'required|integer|min:1',
        ]);

        // Regla de Negocio Crítica: Validar inventario disponible
        $itemsToLoan = [];
        foreach ($request->equipment_ids as $index => $eqId) {
            $qty = $request->quantities[$index] ?? 1;
            $equipment = Equipment::findOrFail($eqId);

            if ($qty > $equipment->available_quantity) {
                return redirect()->back()->withInput()->withErrors([
                    'stock' => "No se puede aceptar el préstamo: el equipo '{$equipment->name}' tiene {$equipment->available_quantity} disponibles y solicitaste {$qty}."
                ]);
            }

            $itemsToLoan[] = [
                'equipment' => $equipment,
                'quantity' => $qty,
            ];
        }

        DB::transaction(function () use ($request, $itemsToLoan) {
            $folio = 'PR-' . strtoupper(Str::random(6));

            $loan = Loan::create([
                'folio' => $folio,
                'user_id' => Auth::id(),
                'date_entrega' => $request->date_entrega,
                'date_final' => $request->date_final,
                'status' => 'pendiente',
            ]);

            foreach ($itemsToLoan as $item) {
                LoanItem::create([
                    'loan_id' => $loan->id,
                    'equipment_id' => $item['equipment']->id,
                    'quantity' => $item['quantity'],
                ]);
            }
        });

        return redirect()->route('loans.status')->with('success', 'Solicitud de préstamo enviada. Espera la autorización del encargado.');
    }

    // Estado del préstamo para Solicitante
    public function status() {
        $loans = Loan::where('user_id', Auth::id())
            ->with(['items.equipment'])
            ->latest()
            ->get();

        return view('loans.status', compact('loans'));
    }

    // Listado global de solicitudes para Encargado
    public function index() {
        $loans = Loan::with(['user', 'items.equipment'])->latest()->get();
        return view('loans.index', compact('loans'));
    }

    // Cambio de Estado por el Encargado (entregado, denegado, devuelto)
    public function updateStatus(Request $request, $id) {
        $request->validate([
            'status' => 'required|in:entregado,denegado,devuelto',
        ]);

        $loan = Loan::with('items.equipment')->findOrFail($id);

        if ($loan->status === $request->status) {
            return redirect()->back()->with('info', 'La solicitud ya tenía este estado.');
        }

        DB::transaction(function () use ($loan, $request) {
            // Transición a ENTREGADO: Descontar stock
            if ($request->status === 'entregado' && $loan->status !== 'entregado') {
                foreach ($loan->items as $item) {
                    if ($item->quantity > $item->equipment->available_quantity) {
                        throw new \Exception("Stock insuficiente para entregar {$item->equipment->name}.");
                    }
                    $item->equipment->decrement('available_quantity', $item->quantity);
                }
            }

            // Transición a DEVUELTO desde ENTREGADO: Reintegrar stock
            if ($request->status === 'devuelto' && $loan->status === 'entregado') {
                foreach ($loan->items as $item) {
                    $item->equipment->increment('available_quantity', $item->quantity);
                }
            }

            $loan->update(['status' => $request->status]);
        });

        return redirect()->back()->with('success', "Estado actualizado a '{$request->status}' con éxito.");
    }
}