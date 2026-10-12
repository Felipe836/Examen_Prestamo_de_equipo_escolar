<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Loan;
use App\Models\Incident;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function index() {
        $user = Auth::user();

        if ($user->isEncargado()) {
            $kpiTotalEquipos = Equipment::sum('total_quantity');
            $kpiEquiposPrestados = Equipment::sum('total_quantity') - Equipment::sum('available_quantity');
            $kpiSolicitudesPendientes = Loan::where('status', 'pendiente')->count();
            $kpiIncidentesPorRevisar = Incident::where('status', 'por_revisar')->count();

            $recentLoans = Loan::with(['user', 'items.equipment'])->latest()->take(5)->get();

            return view('dashboard', compact(
                'kpiTotalEquipos',
                'kpiEquiposPrestados',
                'kpiSolicitudesPendientes',
                'kpiIncidentesPorRevisar',
                'recentLoans'
            ));
        } else {
            $kpiMisSolicitudes = Loan::where('user_id', $user->id)->count();
            $kpiPrestamosActivos = Loan::where('user_id', $user->id)->where('status', 'entregado')->count();
            $kpiIncidentesReportados = Incident::where('user_id', $user->id)->count();
            $kpiEquiposDisponibles = Equipment::sum('available_quantity');

            $recentLoans = Loan::where('user_id', $user->id)->with('items.equipment')->latest()->take(5)->get();

            return view('dashboard', compact(
                'kpiMisSolicitudes',
                'kpiPrestamosActivos',
                'kpiIncidentesReportados',
                'kpiEquiposDisponibles',
                'recentLoans'
            ));
        }
    }
}