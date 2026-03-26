<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ConfiguracionController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $config = DB::table('configuracion')
            ->pluck('valor', 'clave');

        return view('configuracion.moneda', compact('config'));
    }

    public function update(Request $request)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        $request->validate([
            'moneda_simbolo' => 'required|string|max:10',
            'moneda_nombre'  => 'required|string|max:10',
            'moneda_tasa'    => 'required|numeric|min:0.0001',
            'moneda_decimal' => 'required|string|max:1',
            'moneda_miles'   => 'required|string|max:1',
        ], [
            'moneda_simbolo.required' => 'El símbolo es obligatorio.',
            'moneda_nombre.required'  => 'El nombre de la moneda es obligatorio.',
            'moneda_tasa.required'    => 'La tasa de cambio es obligatoria.',
            'moneda_tasa.numeric'     => 'La tasa debe ser un número.',
            'moneda_tasa.min'         => 'La tasa debe ser mayor a 0.',
        ]);

        $campos = ['moneda_simbolo', 'moneda_nombre', 'moneda_tasa', 'moneda_decimal', 'moneda_miles'];

        foreach ($campos as $clave) {
            DB::table('configuracion')
                ->updateOrInsert(
                    ['clave' => $clave],
                    ['valor' => $request->input($clave), 'updated_at' => now()]
                );
        }

        // Limpiar caché para que el cambio aplique de inmediato
        Cache::forget('moneda_config');

        return redirect()->route('configuracion.moneda')
            ->with('mensaje', 'Configuración de moneda actualizada correctamente.');
    }
}