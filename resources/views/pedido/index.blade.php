@extends('plantilla.app')

@push('estilos')
<style>
    :root {
        --rose: #e8b4b8;
        --rose-light: #f5dde0;
        --rose-dark: #c47a82;
        --nude: #f0e6e0;
        --ink: #1a1212;
    }

    .ped-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 24px;
    }
    .ped-title {
        font-size: 22px; font-weight: 600; color: var(--ink); margin: 0;
    }
    .ped-subtitle { font-size: 13px; color: #888; margin-top: 2px; }

    /* Stats */
    .ped-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin-bottom: 24px; }
    .ped-stat {
        background: #fff; border-radius: 12px;
        border: 0.5px solid #f0e0e2; padding: 16px 18px;
    }
    .ped-stat-label { font-size: 11px; color: #999; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px; }
    .ped-stat-value { font-size: 26px; font-weight: 600; color: var(--ink); line-height: 1; }
    .ped-stat-value.warn  { color: #d97706; }
    .ped-stat-value.ok    { color: #059669; }
    .ped-stat-value.dang  { color: #dc2626; }

    /* Search bar */
    .ped-toolbar {
        display: flex; gap: 10px; align-items: center;
        background: #fff; border: 0.5px solid #f0e0e2;
        border-radius: 12px; padding: 14px 16px; margin-bottom: 16px;
    }
    .ped-search-wrap { flex: 1; position: relative; }
    .ped-search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #bbb; }
    .ped-search-input {
        width: 100%; padding: 9px 12px 9px 36px;
        border: 1.5px solid #f0dde0; border-radius: 8px;
        font-size: 13px; color: var(--ink); outline: none; background: #fdf8f8;
        transition: border-color 0.2s;
    }
    .ped-search-input:focus { border-color: var(--rose); }
    .ped-search-btn {
        padding: 9px 22px; background: var(--ink); color: #fff; border: none;
        border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer;
        transition: opacity 0.2s; white-space: nowrap;
    }
    .ped-search-btn:hover { opacity: 0.85; }

    /* Alert */
    .ped-alert {
        padding: 12px 16px; background: #f0fdf4; border: 1px solid #bbf7d0;
        border-radius: 8px; color: #166534; font-size: 13px;
        display: flex; align-items: center; gap: 8px; margin-bottom: 16px;
    }

    /* Table card */
    .ped-table-card {
        background: #fff; border: 0.5px solid #f0e0e2;
        border-radius: 14px; overflow: hidden;
    }
    .ped-table { width: 100%; border-collapse: collapse; }
    .ped-table thead tr { border-bottom: 0.5px solid #f0e0e2; background: #fdf8f8; }
    .ped-table th {
        padding: 11px 16px; font-size: 11px; font-weight: 500; color: #999;
        text-transform: uppercase; letter-spacing: 0.06em; text-align: left; white-space: nowrap;
    }
    .ped-table td { padding: 14px 16px; font-size: 13px; color: var(--ink); border-bottom: 0.5px solid #f5eaea; vertical-align: middle; }
    .ped-table tbody tr:last-child td { border-bottom: none; }
    .ped-table tbody tr:hover td { background: #fdf8f8; }

    /* Badges */
    .ped-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 500;
    }
    .ped-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; display: inline-block; }
    .ped-badge.pendiente  { background: #fef3c7; color: #92400e; }
    .ped-badge.pendiente::before  { background: #d97706; }
    .ped-badge.enviado    { background: #d1fae5; color: #065f46; }
    .ped-badge.enviado::before    { background: #059669; }
    .ped-badge.anulado    { background: #fee2e2; color: #991b1b; }
    .ped-badge.anulado::before    { background: #dc2626; }
    .ped-badge.procesando { background: #eff6ff; color: #1e40af; }
    .ped-badge.procesando::before { background: #3b82f6; }
    .ped-badge.entregado  { background: #f0faf4; color: #1a5c38; }
    .ped-badge.entregado::before  { background: #059669; }
    .ped-badge.cancelado  { background: #f3f4f6; color: #4b5563; }
    .ped-badge.cancelado::before  { background: #9ca3af; }

    /* Botones acción */
    .ped-btn-estado {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px; background: #fef3c7; color: #92400e;
        border: 1px solid #fde68a; border-radius: 8px; font-size: 12px;
        font-weight: 500; cursor: pointer; transition: all 0.15s;
    }
    .ped-btn-estado:hover { background: #fde68a; }
    .ped-btn-detalle {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px; background: #eff6ff; color: #1d4ed8;
        border: 1px solid #bfdbfe; border-radius: 8px; font-size: 12px;
        font-weight: 500; cursor: pointer; transition: all 0.15s;
    }
    .ped-btn-detalle:hover { background: #dbeafe; }

    /* Fila de detalles */
    .ped-detalles-row { background: #fdf8f8 !important; }
    .ped-detalles-row td { padding: 0 !important; border-bottom: 0.5px solid #f0e0e2 !important; }
    .ped-detalles-inner { padding: 16px 20px; }
    .ped-detalles-title { font-size: 12px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 12px; }
    .ped-detalles-table { width: 100%; border-collapse: collapse; }
    .ped-detalles-table th { font-size: 11px; color: #aaa; text-transform: uppercase; letter-spacing: 0.05em; padding: 6px 10px; text-align: left; }
    .ped-detalles-table td { font-size: 13px; color: var(--ink); padding: 8px 10px; border-top: 0.5px solid #f0e0e2; }
    .ped-prod-img { width: 48px; height: 48px; border-radius: 8px; object-fit: cover; border: 0.5px solid #f0e0e2; }

    /* Paginación */
    .ped-footer { padding: 14px 16px; border-top: 0.5px solid #f5eaea; display: flex; justify-content: space-between; align-items: center; }
    .ped-count { font-size: 12px; color: #999; }
    .ped-footer .pagination { margin: 0; gap: 4px; }
    .ped-footer .page-link { border-radius: 8px !important; border-color: #f0e0e2; color: #888; font-size: 12px; padding: 5px 12px; }
    .ped-footer .page-item.active .page-link { background: var(--ink); border-color: var(--ink); color: #fff; }

    /* Modal */
    .ped-modal .modal-content { border: none; border-radius: 16px; overflow: hidden; }
    .ped-modal .modal-header { background: var(--ink); color: #fff; border: none; padding: 18px 20px; }
    .ped-modal .modal-title { font-size: 15px; font-weight: 500; }
    .ped-modal .modal-body { padding: 20px; }
    .ped-modal .modal-footer { border-top: 0.5px solid #f0e0e2; padding: 14px 20px; }
    .ped-modal select {
        width: 100%; padding: 10px 14px; border: 1.5px solid #f0dde0;
        border-radius: 8px; font-size: 14px; color: var(--ink);
        background: #fdf8f8; outline: none;
    }
    .ped-modal select:focus { border-color: var(--rose); }
    .ped-modal .btn-cancelar {
        padding: 9px 18px; background: transparent; color: #888;
        border: 0.5px solid #ddd; border-radius: 8px; font-size: 13px; cursor: pointer;
    }
    .ped-modal .btn-guardar {
        padding: 9px 20px; background: var(--ink); color: #fff;
        border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer;
    }
    .ped-modal .btn-guardar:hover { opacity: 0.85; }

    /* Empty */
    .ped-empty { padding: 56px 20px; text-align: center; }
    .ped-empty-icon { width: 52px; height: 52px; background: #fdf0f0; border-radius: 50%; margin: 0 auto 14px; display: flex; align-items: center; justify-content: center; }
</style>
@endpush

@section('contenido')
<div class="app-content">
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="ped-header">
            <div>
                <h1 class="ped-title">Pedidos</h1>
                <p class="ped-subtitle">Gestión y seguimiento de órdenes</p>
            </div>
        </div>

        {{-- STATS --}}
        <div class="ped-stats">
            <div class="ped-stat">
                <div class="ped-stat-label">Total pedidos</div>
                <div class="ped-stat-value">{{ $registros->total() }}</div>
            </div>
            <div class="ped-stat">
                <div class="ped-stat-label">Pendientes</div>
                <div class="ped-stat-value warn">
                    {{ $registros->getCollection()->where('estado','pendiente')->count() }}
                </div>
            </div>
            <div class="ped-stat">
                <div class="ped-stat-label">Enviados</div>
                <div class="ped-stat-value ok">
                    {{ $registros->getCollection()->where('estado','enviado')->count() }}
                </div>
            </div>
            <div class="ped-stat">
                <div class="ped-stat-label">Anulados</div>
                <div class="ped-stat-value dang">
                    {{ $registros->getCollection()->where('estado','anulado')->count() }}
                </div>
            </div>
        </div>

        {{-- TOOLBAR --}}
        <form action="{{ route('perfil.pedidos') }}" method="GET">
            <div class="ped-toolbar">
                <div class="ped-search-wrap">
                    <svg class="ped-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input class="ped-search-input" type="text" name="texto"
                           placeholder="Buscar por usuario..." value="{{ $texto }}">
                </div>
                <button type="submit" class="ped-search-btn">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
            </div>
        </form>

        {{-- ALERTA --}}
        @if(Session::has('mensaje'))
            <div class="ped-alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ Session::get('mensaje') }}
            </div>
        @endif

        {{-- TABLA --}}
        <div class="ped-table-card">
            <table class="ped-table">
                <thead>
                    <tr>
                        <th>Opciones</th>
                        <th>#ID</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    @if($registros->count() === 0)
                        <tr>
                            <td colspan="7">
                                <div class="ped-empty">
                                    <div class="ped-empty-icon">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="1.5">
                                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                            <line x1="3" y1="6" x2="21" y2="6"/>
                                            <path d="M16 10a4 4 0 0 1-8 0"/>
                                        </svg>
                                    </div>
                                    <p style="font-size:14px;font-weight:600;color:#1a1212;margin-bottom:4px;">Sin pedidos</p>
                                    <p style="font-size:12px;color:#999;">No hay registros que coincidan con la búsqueda</p>
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach($registros as $reg)
                            {{-- Fila principal --}}
                            <tr>
                                <td>
                                    <button class="ped-btn-estado" data-bs-toggle="modal"
                                        data-bs-target="#modal-estado-{{ $reg->id }}">
                                        <i class="bi bi-arrow-repeat"></i> Estado
                                    </button>
                                </td>
                                <td style="font-weight:500;">#{{ $reg->id }}</td>
                                <td style="color:#888;">{{ $reg->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <div style="width:30px;height:30px;border-radius:50%;background:#f5dde0;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;color:#c47a82;">
                                            {{ strtoupper(substr($reg->user->name, 0, 1)) }}
                                        </div>
                                        {{ $reg->user->name }}
                                    </div>
                                </td>
                                <td style="font-weight:600;">{{ moneda($reg->total) }}</td>
                                <td>
                                    <span class="ped-badge {{ $reg->estado }}">
                                        {{ ucfirst($reg->estado) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="ped-btn-detalle" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#detalles-{{ $reg->id }}">
                                        <i class="bi bi-eye"></i> Ver
                                    </button>
                                </td>
                            </tr>

                            {{-- Fila de detalles colapsable --}}
                            <tr class="ped-detalles-row collapse" id="detalles-{{ $reg->id }}">
                                <td colspan="7">
                                    <div class="ped-detalles-inner">
                                        <p class="ped-detalles-title">Detalle del pedido #{{ $reg->id }}</p>
                                        <table class="ped-detalles-table">
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio unit.</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($reg->detalles as $detalle)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ asset('uploads/productos/' . $detalle->producto->imagen) }}"
                                                                 class="ped-prod-img"
                                                                 alt="{{ $detalle->producto->nombre }}">
                                                        </td>
                                                        <td style="font-weight:500;">{{ $detalle->producto->nombre }}</td>
                                                        <td>{{ $detalle->cantidad }}</td>
                                                        <td>{{ moneda($detalle->precio) }}</td>
                                                        <td style="font-weight:600;">{{ moneda($detalle->cantidad * $detalle->precio) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal cambiar estado --}}
                            <div class="modal fade ped-modal" id="modal-estado-{{ $reg->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('pedidos.cambiar.estado', $reg->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-truck me-2"></i>
                                                    Gestionar envío — Pedido #{{ $reg->id }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p style="font-size:13px;color:#888;margin-bottom:16px;">
                                                    Estado actual:
                                                    <span class="ped-badge {{ $reg->estado }}" style="margin-left:6px;">{{ ucfirst($reg->estado) }}</span>
                                                </p>

                                                @php
                                                    $flujo = [
                                                        'pendiente'  => ['procesando' => '📦 Procesando', 'anulado' => '❌ Anular'],
                                                        'procesando' => ['enviado' => '🚚 Enviado', 'anulado' => '❌ Anular'],
                                                        'enviado'    => ['entregado' => '✅ Entregado', 'anulado' => '❌ Anular'],
                                                        'entregado'  => [],
                                                        'anulado'    => [],
                                                        'cancelado'  => [],
                                                    ];
                                                    $opciones = $flujo[$reg->estado] ?? [];
                                                @endphp

                                                @if(count($opciones))
                                                    <label style="font-size:12px;font-weight:500;color:#666;margin-bottom:8px;display:block;">
                                                        Cambiar a:
                                                    </label>
                                                    <select name="estado" style="width:100%;padding:10px 12px;border:1.5px solid #f0dde0;border-radius:10px;font-size:13px;background:#fdf8f8;outline:none;">
                                                        @foreach($opciones as $val => $label)
                                                            <option value="{{ $val }}">{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p style="font-size:11px;color:#aaa;margin-top:10px;">
                                                        <i class="bi bi-bell me-1"></i>
                                                        Se enviará una notificación al cliente al guardar.
                                                    </p>
                                                @else
                                                    <div style="text-align:center;padding:16px;color:#aaa;font-size:13px;">
                                                        <i class="bi bi-lock" style="font-size:24px;display:block;margin-bottom:8px;"></i>
                                                        Este pedido ya no puede cambiar de estado.
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn-cancelar" data-bs-dismiss="modal">Cerrar</button>
                                                @if(count($opciones))
                                                    <button type="submit" class="btn-guardar">
                                                        <i class="bi bi-check2 me-1"></i> Guardar cambio
                                                    </button>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </tbody>
            </table>

            {{-- PAGINACIÓN --}}
            <div class="ped-footer">
                <span class="ped-count">{{ $registros->total() }} registros encontrados</span>
                {{ $registros->appends(['texto' => $texto])->links() }}
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('mnuPedidos').classList.add('active');
</script>
@endpush