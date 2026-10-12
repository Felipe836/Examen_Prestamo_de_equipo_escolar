<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Incident;
use App\Models\Loan;
use App\Models\LoanItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // 1. Usuarios Obligatorios
        $encargado = User::create([
            'name' => 'Carlos Encargado',
            'email' => 'encargado@prestahard.com',
            'password' => Hash::make('password123'),
            'address' => 'Oficina Central PrestaHard #101',
            'role' => 'encargado',
        ]);

        $solicitante = User::create([
            'name' => 'Juan Solicitante',
            'email' => 'solicitante@prestahard.com',
            'password' => Hash::make('password123'),
            'address' => 'Edificio B, Depto 402',
            'role' => 'solicitante',
        ]);

        // 2. Categorías
        $catLaptops = Category::create(['name' => 'Laptops', 'description' => 'Equipos de cómputo portátiles']);
        $catMonitores = Category::create(['name' => 'Monitores', 'description' => 'Pantallas externas FHD / 4K']);
        $catRedes = Category::create(['name' => 'Routers & Redes', 'description' => 'Equipos de conectividad']);

        // 3. Inventario Inicial
        $laptop = Equipment::create([
            'category_id' => $catLaptops->id,
            'name' => 'Laptop Dell Latitude 3420',
            'total_quantity' => 10,
            'available_quantity' => 7,
            'specifications' => 'Intel i5 11va Gen, 16GB RAM, 512GB SSD',
        ]);

        $monitor = Equipment::create([
            'category_id' => $catMonitores->id,
            'name' => 'Monitor LG 24 Pulgadas',
            'total_quantity' => 5,
            'available_quantity' => 5,
            'specifications' => 'Panel IPS, 75Hz, HDMI/VGA',
        ]);

        $router = Equipment::create([
            'category_id' => $catRedes->id,
            'name' => 'Router TP-Link Archer C6',
            'total_quantity' => 4,
            'available_quantity' => 4,
            'specifications' => 'Banda Dual AC1200, 4 Antenas',
        ]);

        // 4. Préstamo de Prueba
        $loan = Loan::create([
            'folio' => 'PR-SEEDED01',
            'user_id' => $solicitante->id,
            'date_entrega' => date('Y-m-d'),
            'date_final' => date('Y-m-d', strtotime('+3 days')),
            'status' => 'entregado',
        ]);

        LoanItem::create([
            'loan_id' => $loan->id,
            'equipment_id' => $laptop->id,
            'quantity' => 3,
        ]);

        // 5. Incidente de Prueba
        Incident::create([
            'loan_id' => $loan->id,
            'equipment_id' => $laptop->id,
            'user_id' => $solicitante->id,
            'damage' => 'Tecla Espacio trabada',
            'specifications' => 'La tecla no retrocede correctamente tras presionar.',
            'status' => 'por_revisar',
        ]);
    }
}