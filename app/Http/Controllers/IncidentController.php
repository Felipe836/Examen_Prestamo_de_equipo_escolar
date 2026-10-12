<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Incident;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller {
    public function index() {
        $user = Auth::user();

        if ($user->isEncargado()) {
            $incidents = Incident::with(['user', 'equipment', 'loan'])->latest()->get();
        } else {
            $incidents = Incident::where('user_id', $user->id)->with(['equipment', 'loan'])->latest()->get();
        }

        $equipments = Equipment::all();
        $loans = Loan::where('user_id', $user->id)->whereIn('status', ['entregado', 'devuelto'])->get();

        return view('incidents.index', compact('incidents', 'equipments', 'loans'));
    }

    public function store(Request $request) {
        $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'loan_id' => 'nullable|exists:loans,id',
            'damage' => 'required|string|max:255',
            'specifications' => 'nullable|string',
        ]);

        Incident::create([
            'equipment_id' => $request->equipment_id,
            'loan_id' => $request->loan_id,
            'user_id' => Auth::id(),
            'damage' => $request->damage,
            'specifications' => $request->specifications,
            'status' => 'por_revisar',
        ]);

        return redirect()->back()->with('success', 'Incidente reportado correctamente.');
    }

    public function markRepaired($id) {
        $incident = Incident::findOrFail($id);
        $incident->update(['status' => 'reparado']);

        return redirect()->back()->with('success', 'Incidente marcado como reparado.');
    }
}