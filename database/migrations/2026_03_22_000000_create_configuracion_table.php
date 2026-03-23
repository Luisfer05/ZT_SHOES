<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id();
            $table->string('clave', 60)->unique();
            $table->string('valor', 255);
            $table->timestamps();
        });

        // Valores por defecto — USD como moneda base
        DB::table('configuracion')->insert([
            ['clave' => 'moneda_simbolo', 'valor' => '$',      'created_at' => now(), 'updated_at' => now()],
            ['clave' => 'moneda_nombre',  'valor' => 'USD',    'created_at' => now(), 'updated_at' => now()],
            ['clave' => 'moneda_tasa',    'valor' => '1',      'created_at' => now(), 'updated_at' => now()],
            ['clave' => 'moneda_decimal', 'valor' => '.',      'created_at' => now(), 'updated_at' => now()],
            ['clave' => 'moneda_miles',   'valor' => ',',      'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion');
    }
};