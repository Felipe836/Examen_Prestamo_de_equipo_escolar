<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Landing Page Pública
Route::get('/', [PublicController::class, 'index'])->name('landing');

// Autenticación Libre (Sencilla sin Librerías Externas)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas Protegidas por Autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Incidentes (Compartido)
    Route::get('/incidents', [IncidentController::class, 'index'])->name('incidents.index');
    Route::post('/incidents', [IncidentController::class, 'store'])->name('incidents.store');

    // Rutas Exclusivas para Solicitante
    Route::middleware(['role:solicitante'])->group(function () {
        Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
        Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
        Route::get('/loans/status', [LoanController::class, 'status'])->name('loans.status');
    });

    // Rutas Exclusivas para Encargado
    Route::middleware(['role:encargado'])->group(function () {
        // Administrar Equipos y Categorías
        Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
        Route::post('/categories', [EquipmentController::class, 'storeCategory'])->name('categories.store');
        Route::post('/equipment', [EquipmentController::class, 'storeEquipment'])->name('equipment.store');
        Route::put('/equipment/{id}', [EquipmentController::class, 'updateEquipment'])->name('equipment.update');
        Route::delete('/equipment/{id}', [EquipmentController::class, 'destroyEquipment'])->name('equipment.destroy');

        // Decidir y Gestionar Solicitudes
        Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
        Route::patch('/loans/{id}/status', [LoanController::class, 'updateStatus'])->name('loans.updateStatus');

        // Atender Incidentes
        Route::patch('/incidents/{id}/repair', [IncidentController::class, 'markRepaired'])->name('incidents.repair');
    });
});