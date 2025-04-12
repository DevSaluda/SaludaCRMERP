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
        // Añadir la clave foránea después de que ambas tablas existan
        Schema::table('users', function (Blueprint $table) {
            // Asumiendo que ambas tablas existen en este punto
            $table->foreign('licencia_id')
                  ->references('id')
                  ->on('licencias')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['licencia_id']);
        });
    }
};
