@extends('plantilla.app')

@push('estilos')
<style>
    :root {
        --rose:      #e8b4b8;
        --rose-light:#f5dde0;
        --rose-dark: #c47a82;
        --ink:       #1a1212;
        --muted:     #7a6060;
    }

    .dash-wrap { padding: 28px 32px; }

    /* ── Saludo ── */
    .dash-greeting {
        margin-bottom: 28px;
    }
    .dash-greeting h1 {
        font-size: 22px; font-weight: 600; color: var(--ink); margin-bottom: 4px;
    }
    .dash-greeting p { font-size: 13px; color: var(--muted); }

    /* ── Contadores ── */
    .dash-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: #fff;
        border-radius: 14px;
        padding: 20px 22px;
        border: 0.5px solid #f0e0e2;
        display: flex; align-items: center; gap: 16px;
        transition: box-shadow 0.2s;
    }
    .stat-card:hover { box-shadow: 0 6px 20px rgba(196,122,130,0.12); }

    .stat-icon {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; flex-shrink: 0;
    }
    .stat-icon.rose     { background: #fdf0f1; color: var(--rose-dark); }
    .stat-icon.ink      { background: #f0eded; color: var(--ink); }
    .stat-icon.green    { background: #f0faf4; color: #2d9e60; }
    .stat-icon.amber    { background: #fffbf0; color: #c48a1a; }

    .stat-info {}
    .stat-num {
        font-size: 26px; font-weight: 700; color: var(--ink); line-height: 1;
    }
    .stat-label { font-size: 12px; color: var(--muted); margin-top: 4px; }

    /* ── Fila de 2 columnas ── */
    .dash-row {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .dash-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* ── Card genérica ── */
    .dash-card {
        background: #fff;
        border-radius: 14px;
        border: 0.5px solid #f0e0e2;
        overflow: hidden;
    }

    .dash-card-header {
        padding: 16px 20px;
        border-bottom: 0.5px solid #f0e0e2;
        display: flex; align-items: center; justify-content: space-between;
    }
    .dash-card-header h2 {
        font-size: 14px; font-weight: 600; color: var(--ink); margin: 0;
    }
    .dash-card-header a {
        font-size: 12px; color: var(--rose-dark); text-decoration: none;
    }
    .dash-card-header a:hover { text-decoration: underline; }

    .dash-card-body { padding: 16px 20px; }

    /* ── Tabla pedidos recientes ── */
    .dash-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .dash-table th {
        text-align: left; padding: 8px 12px;
        font-size: 11px; font-weight: 500;
        text-transform: uppercase; letter-spacing: 0.08em;
        color: var(--muted); border-bottom: 0.5px solid #f0e0e2;
    }
    .dash-table td {
        padding: 12px 12px; color: var(--ink);
        border-bottom: 0.5px solid #fdf0f1;
        vertical-align: middle;
    }
    .dash-table tr:last-child td { border-bottom: none; }
    .dash-table tr:hover td { background: #fdf8f8; }

    .dash-avatar {
        width: 30px; height: 30px; border-radius: 50%;
        background: var(--rose-light);
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 600; color: var(--rose-dark);
        margin-right: 8px; vertical-align: middle;
    }

    /* Badges de estado */
    .badge-estado {
        display: inline-block; padding: 3px 10px; border-radius: 20px;
        font-size: 11px; font-weight: 500; letter-spacing: 0.03em;
    }
    .badge-pendiente  { background: #fff8e6; color: #b07d0a; }
    .badge-procesando { background: #e8f4ff; color: #1a6cb0; }
    .badge-enviado    { background: #f0faf4; color: #1a7a45; }
    .badge-entregado  { background: #f0faf4; color: #1a5c38; }
    .badge-anulado    { background: #fff0f0; color: #b02020; }

    /* ── Productos más vendidos ── */
    .top-product {
        display: flex; align-items: center; gap: 12px;
        padding: 10px 0;
        border-bottom: 0.5px solid #fdf0f1;
    }
    .top-product:last-child { border-bottom: none; }

    .top-product-img {
        width: 44px; height: 44px; border-radius: 10px;
        background: var(--rose-light); overflow: hidden; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
    }
    .top-product-img img { width: 100%; height: 100%; object-fit: cover; }

    .top-product-info { flex: 1; min-width: 0; }
    .top-product-name {
        font-size: 13px; font-weight: 500; color: var(--ink);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .top-product-units { font-size: 11px; color: var(--muted); margin-top: 2px; }

    .top-product-price {
        font-size: 14px; font-weight: 600; color: var(--ink);
        white-space: nowrap; font-family: Georgia, serif;
    }

    /* ── Gráfica ── */
    .chart-wrap { position: relative; height: 220px; }

    /* ── Ventas totales ── */
    .dash-revenue {
        display: flex; align-items: center; gap: 8px;
        padding: 12px 20px;
        background: var(--ink); border-radius: 10px; margin-bottom: 16px;
        color: #fff;
    }
    .dash-revenue-num {
        font-size: 22px; font-weight: 700;
        font-family: Georgia, serif;
    }
    .dash-revenue-label { font-size: 12px; color: rgba(255,255,255,0.55); }

    /* ── Empty ── */
    .dash-empty {
        text-align: center; padding: 32px 16px;
        color: var(--muted); font-size: 13px;
    }

    @media (max-width: 1100px) {
        .dash-stats { grid-template-columns: repeat(2, 1fr); }
        .dash-row   { grid-template-columns: 1fr; }
        .dash-row-2 { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
        .dash-stats { grid-template-columns: 1fr 1fr; }
        .dash-wrap  { padding: 16px; }
    }
</style>
@endpush

@section('contenido')
<div class="app-content">
<div class="dash-wrap">

    {{-- ── Saludo ── --}}
    <div class="dash-greeting">
        <h1>Bienvenido, {{ auth()->user()->name }} 👋</h1>
        <p>{{ now()->format('l, d \d\e F \d\e Y') }} — Resumen general de ZT|SHOES</p>
    </div>

    {{-- ── Contadores ── --}}
    <div class="dash-stats">
        <div class="stat-card">
            <div class="stat-icon rose"><i class="bi bi-bag-fill"></i></div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalPedidos }}</div>
                <div class="stat-label">Pedidos totales</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon ink"><i class="bi bi-people-fill"></i></div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalUsuarios }}</div>
                <div class="stat-label">Usuarios registrados</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-box-seam-fill"></i></div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalProductos }}</div>
                <div class="stat-label">Productos activos</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon amber"><i class="bi bi-clock-history"></i></div>
            <div class="stat-info">
                <div class="stat-num">{{ $pedidosPendientes }}</div>
                <div class="stat-label">Pedidos pendientes</div>
            </div>
        </div>
    </div>

    {{-- ── Fila: pedidos recientes + top productos ── --}}
    <div class="dash-row">

        {{-- Pedidos recientes --}}
        <div class="dash-card">
            <div class="dash-card-header">
                <h2><i class="bi bi-receipt me-2" style="color:var(--rose-dark)"></i>Pedidos recientes</h2>
                <a href="{{ route('perfil.pedidos') }}">Ver todos →</a>
            </div>
            <div style="overflow-x:auto;">
                @if($pedidosRecientes->count())
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidosRecientes as $pedido)
                        <tr>
                            <td style="color:var(--muted); font-size:12px;">#{{ $pedido->id }}</td>
                            <td>
                                <span class="dash-avatar">{{ strtoupper(substr($pedido->user->name ?? 'U', 0, 1)) }}</span>
                                {{ $pedido->user->name ?? 'Usuario eliminado' }}
                            </td>
                            <td style="font-weight:600;">${{ number_format($pedido->total, 2) }}</td>
                            <td>
                                <span class="badge-estado badge-{{ $pedido->estado }}">
                                    {{ ucfirst($pedido->estado) }}
                                </span>
                            </td>
                            <td style="color:var(--muted); font-size:12px;">
                                {{ $pedido->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="dash-empty">No hay pedidos aún.</div>
                @endif
            </div>
        </div>

        {{-- Top productos --}}
        <div class="dash-card">
            <div class="dash-card-header">
                <h2><i class="bi bi-trophy-fill me-2" style="color:var(--rose-dark)"></i>Más vendidos</h2>
            </div>
            <div class="dash-card-body">
                @if($topProductos->count())
                    @foreach($topProductos as $item)
                    <div class="top-product">
                        <div class="top-product-img">
                            @if($item->producto && $item->producto->imagen)
                                <img src="{{ asset('uploads/productos/' . $item->producto->imagen) }}"
                                     alt="{{ $item->producto->nombre }}">
                            @else
                                <span style="font-size:20px;">👟</span>
                            @endif
                        </div>
                        <div class="top-product-info">
                            <div class="top-product-name">{{ $item->producto->nombre ?? 'Producto eliminado' }}</div>
                            <div class="top-product-units">{{ $item->total_vendido }} unidades vendidas</div>
                        </div>
                        <div class="top-product-price">
                            ${{ number_format($item->producto->precio ?? 0, 2) }}
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="dash-empty">Sin ventas registradas.</div>
                @endif
            </div>
        </div>

    </div>

    {{-- ── Gráfica pedidos por mes ── --}}
    <div class="dash-row-2">

        <div class="dash-card">
            <div class="dash-card-header">
                <h2><i class="bi bi-bar-chart-fill me-2" style="color:var(--rose-dark)"></i>Pedidos por mes</h2>
                <span style="font-size:12px; color:var(--muted);">Últimos 6 meses</span>
            </div>
            <div class="dash-card-body">
                <div class="chart-wrap">
                    <canvas id="chartPedidos"></canvas>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-header">
                <h2><i class="bi bi-currency-dollar me-2" style="color:var(--rose-dark)"></i>Ingresos por mes</h2>
                <span style="font-size:12px; color:var(--muted);">Últimos 6 meses</span>
            </div>
            <div class="dash-card-body">
                <div class="dash-revenue">
                    <div>
                        <div class="dash-revenue-label">Total acumulado</div>
                        <div class="dash-revenue-num">${{ number_format($totalIngresos, 2) }}</div>
                    </div>
                    <i class="bi bi-graph-up-arrow ms-auto" style="font-size:24px; color:var(--rose);"></i>
                </div>
                <div class="chart-wrap" style="height:160px;">
                    <canvas id="chartIngresos"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.getElementById('mnuDashboard').classList.add('active');

const meses  = @json($meses);
const pedidosPorMes  = @json($pedidosPorMes);
const ingresosPorMes = @json($ingresosPorMes);

// ── Gráfica pedidos ──
new Chart(document.getElementById('chartPedidos'), {
    type: 'bar',
    data: {
        labels: meses,
        datasets: [{
            label: 'Pedidos',
            data: pedidosPorMes,
            backgroundColor: 'rgba(196,122,130,0.25)',
            borderColor: '#c47a82',
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true, ticks: { stepSize: 1, color: '#7a6060', font: { size: 11 } },
                grid: { color: '#f0e0e2' }, border: { display: false }
            },
            x: {
                ticks: { color: '#7a6060', font: { size: 11 } },
                grid: { display: false }, border: { display: false }
            }
        }
    }
});

// ── Gráfica ingresos ──
new Chart(document.getElementById('chartIngresos'), {
    type: 'line',
    data: {
        labels: meses,
        datasets: [{
            label: 'Ingresos $',
            data: ingresosPorMes,
            borderColor: '#1a1212',
            backgroundColor: 'rgba(26,18,18,0.06)',
            borderWidth: 2,
            pointBackgroundColor: '#1a1212',
            pointRadius: 4,
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: '#7a6060', font: { size: 11 },
                    callback: v => '$' + v.toLocaleString() },
                grid: { color: '#f0e0e2' }, border: { display: false }
            },
            x: {
                ticks: { color: '#7a6060', font: { size: 11 } },
                grid: { display: false }, border: { display: false }
            }
        }
    }
});
</script>
@endpush