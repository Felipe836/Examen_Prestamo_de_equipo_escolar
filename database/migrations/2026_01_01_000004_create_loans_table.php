<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('date_entrega');
            $table->date('date_final');
            $table->enum('status', ['pendiente', 'entregado', 'denegado', 'devuelto'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('loans');
    }
};