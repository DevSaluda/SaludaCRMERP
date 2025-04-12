<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hospital_licencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('licencia_id');
            $table->date('fecha_asignacion')->nullable();
            $table->string('estado', 20)->default('activa');
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->foreign('licencia_id')
                  ->references('id')
                  ->on('licencias')
                  ->onDelete('cascade');
                  
            // La referencia a la tabla hospital se deberá agregar cuando exista dicha tabla
            // o cambiar según la estructura específica del sistema
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_licencias');
    }
}; 