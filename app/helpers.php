<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Obtiene la configuración de moneda (con caché de 60 min).
 */
function moneda_config(): array
{
    return Cache::remember('moneda_config', 3600, function () {
        // Si la tabla aún no existe (durante migraciones), retorna USD por defecto
        if (!Schema::hasTable('configuracion')) {
            return [
                'simbolo'  => '$',
                'nombre'   => 'USD',
                'tasa'     => 1.0,
                'decimal'  => '.',
                'miles'    => ',',
            ];
        }

        $rows = DB::table('configuracion')
            ->whereIn('clave', ['moneda_simbolo','moneda_nombre','moneda_tasa','moneda_decimal','moneda_miles'])
            ->pluck('valor', 'clave');

        return [
            'simbolo'  => $rows['moneda_simbolo'] ?? '$',
            'nombre'   => $rows['moneda_nombre']  ?? 'USD',
            'tasa'     => (float)($rows['moneda_tasa']    ?? 1),
            'decimal'  => $rows['moneda_decimal'] ?? '.',
            'miles'    => $rows['moneda_miles']   ?? ',',
        ];
    });
}

/**
 * Convierte y formatea un precio según la moneda configurada.
 *
 * Uso en Blade:  {{ moneda($producto->precio) }}
 */
function moneda(float $precio, int $decimales = 2): string
{
    $cfg    = moneda_config();
    $valor  = $precio * $cfg['tasa'];

    return $cfg['simbolo'] . number_format($valor, $decimales, $cfg['decimal'], $cfg['miles']);
}