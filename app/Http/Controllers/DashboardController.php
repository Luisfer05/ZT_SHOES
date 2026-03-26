<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);

        // ── Contadores ────────────────────────────────────────
        $totalPedidos      = Pedido::count();
        $totalUsuarios     = User::count();
        $totalProductos    = Producto::count();
        $pedidosPendientes = Pedido::where('estado', 'pendiente')->count();
        $totalIngresos     = Pedido::whereNotIn('estado', ['anulado'])->sum('total');

        // ── Pedidos recientes (últimos 8) ─────────────────────
        $pedidosRecientes = Pedido::with('user')
            ->latest()
            ->take(8)
            ->get();

        // ── Top 5 productos más vendidos ──────────────────────
        $topProductos = PedidoDetalle::select('producto_id', DB::raw('SUM(cantidad) as total_vendido'))
            ->with('producto')
            ->groupBy('producto_id')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get();

        // ── Últimos 6 meses ───────────────────────────────────
        $meses          = [];
        $pedidosPorMes  = [];
        $ingresosPorMes = [];

        for ($i = 5; $i >= 0; $i--) {
            $fecha = Carbon::now()->subMonths($i);
            $meses[] = $fecha->translatedFormat('M');

            $pedidosPorMes[] = Pedido::whereYear('created_at', $fecha->year)
                ->whereMonth('created_at', $fecha->month)
                ->count();

            $ingresosPorMes[] = (float) Pedido::whereYear('created_at', $fecha->year)
                ->whereMonth('created_at', $fecha->month)
                ->whereNotIn('estado', ['anulado'])
                ->sum('total');
        }

        return view('dashboard', compact(
            'totalPedidos',
            'totalUsuarios',
            'totalProductos',
            'pedidosPendientes',
            'totalIngresos',
            'pedidosRecientes',
            'topProductos',
            'meses',
            'pedidosPorMes',
            'ingresosPorMes',
        ));
    }
}