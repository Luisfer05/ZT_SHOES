<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Agregar dirección de envío al pedido
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('direccion')->nullable()->after('estado');
            $table->string('ciudad')->nullable()->after('direccion');
            $table->string('telefono', 20)->nullable()->after('ciudad');
            $table->text('notas')->nullable()->after('telefono');
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn(['direccion', 'ciudad', 'telefono', 'notas']);
        });
    }
};
