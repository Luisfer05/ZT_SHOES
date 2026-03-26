<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // pedido_detalles: precio de decimal(6,2) a decimal(12,2)
        Schema::table('pedido_detalles', function (Blueprint $table) {
            $table->decimal('precio', 12, 2)->change();
        });

        // pedidos: total de decimal(10,2) ya está bien, pero por seguridad lo dejamos en 14
        Schema::table('pedidos', function (Blueprint $table) {
            $table->decimal('total', 14, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('pedido_detalles', function (Blueprint $table) {
            $table->decimal('precio', 6, 2)->change();
        });

        Schema::table('pedidos', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->change();
        });
    }
};