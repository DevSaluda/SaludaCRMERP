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
        Schema::create('licencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_hospital', 150);
            $table->string('direccion', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('sitio_web', 150)->nullable();
            $table->string('codigo_licencia', 100)->unique();
            $table->date('fecha_inicio');
            $table->date('fecha_vencimiento');
            $table->string('estado', 20)->default('activa');
            $table->text('notas')->nullable();
            $table->boolean('es_principal')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licencias');
    }
};
