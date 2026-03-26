<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class WebController extends Controller
{
    // ── Página de inicio (landing) ──────────────────────────────
    public function home()
    {
        // Productos marcados para el slider "Nueva Colección"
        $coleccion = Producto::where('en_coleccion', true)
                        ->whereNotNull('imagen')
                        ->latest()
                        ->get();

        // 4 productos más recientes para la sección "Productos destacados"
        $destacados = Producto::latest()->take(4)->get();

        return view('web.home', compact('destacados', 'coleccion'));
    }

    // ── Tienda con buscador y paginación ────────────────────────
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'priceAsc'  => $query->orderBy('precio', 'asc'),
                'priceDesc' => $query->orderBy('precio', 'desc'),
                default     => $query->orderBy('nombre', 'asc'),
            };
        }

        $productos = $query->paginate(10);

        return view('web.index', compact('productos'));
    }

    // ── Detalle de producto ─────────────────────────────────────
    public function show($id)
    {
        $producto = Producto::findOrFail($id);

        return view('web.item', compact('producto'));
    }
}