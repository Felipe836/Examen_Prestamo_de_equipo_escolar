<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->nullable()->constrained('loans')->onDelete('set null');
            $table->foreignId('equipment_id')->constrained('equipment')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('damage');
            $table->text('specifications')->nullable();
            $table->enum('status', ['por_revisar', 'reparado'])->default('por_revisar');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('incidents');
    }
};