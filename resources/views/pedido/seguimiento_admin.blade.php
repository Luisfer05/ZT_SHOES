@extends('plantilla.app')

@push('estilos')
<style>
    :root {
        --rose: #e8b4b8; --rose-light: #f5dde0;
        --rose-dark: #c47a82; --nude: #f0e6e0;
        --ink: #1a1212; --muted: #7a6060;
    }

    .seg-page { padding: 8px 0 40px; }

    /* Back button */
    .seg-back {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 13px; color: var(--muted); text-decoration: none;
        margin-bottom: 20px; transition: color 0.15s;
    }
    .seg-back:hover { color: var(--ink); }

    /* Header */
    .seg-header {
        display: flex; align-items: flex-start; justify-content: space-between;
        margin-bottom: 24px; flex-wrap: wrap; gap: 12px;
    }
    .seg-title { font-size: 22px; font-weight: 600; color: var(--ink); margin: 0; }
    .seg-subtitle { font-size: 13px; color: #888; margin-top: 3px; }

    /* Card general */
    .seg-card {
        background: #fff; border-radius: 16px;
        border: 0.5px solid #f0e0e2; margin-bottom: 20px; overflow: hidden;
    }

    /* Cabecera del pedido */
    .seg-ped-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 24px; background: #fdf8f8;
        border-bottom: 0.5px solid #f0e0e2; flex-wrap: wrap; gap: 12px;
    }
    .seg-ped-id   { font-size: 16px; font-weight: 600; color: var(--ink); }
    .seg-ped-date { font-size: 12px; color: var(--muted); margin-top: 3px; }
    .seg-ped-total {
        font-family: 'Cormorant Garamond', serif;
        font-size: 26px; font-weight: 600; color: var(--ink);
    }
    .seg-ped-right { display: flex; align-items: center; gap: 16px; }

    /* Usuario */
    .seg-user {
        display: flex; align-items: center; gap: 10px;
        padding: 16px 24px; border-bottom: 0.5px solid #f0e0e2;
    }
    .seg-user-avatar {
        width: 38px; height: 38px; border-radius: 50%;
        background: #f5dde0; display: flex; align-items: center;
        justify-content: center; font-size: 14px; font-weight: 600; color: #c47a82;
        flex-shrink: 0;
    }
    .seg-user-name  { font-size: 14px; font-weight: 500; color: var(--ink); }
    .seg-user-email { font-size: 12px; color: var(--muted); }

    /* Badge estado */
    .seg-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 500;
    }
    .seg-badge::before { content:''; width:6px; height:6px; border-radius:50%; display:inline-block; }
    .seg-badge.pendiente  { background:#fef3c7; color:#92400e; }
    .seg-badge.pendiente::before  { background:#d97706; }
    .seg-badge.procesando { background:#eff6ff; color:#1e40af; }
    .seg-badge.procesando::before { background:#3b82f6; }
    .seg-badge.enviado    { background:#f0fdf4; color:#166534; }
    .seg-badge.enviado::before    { background:#22c55e; }
    .seg-badge.entregado  { background:#f0faf4; color:#1a5c38; }
    .seg-badge.entregado::before  { background:#059669; }
    .seg-badge.anulado    { background:#fff0f0; color:#991b1b; }
    .seg-badge.anulado::before    { background:#ef4444; }
    .seg-badge.cancelado  { background:#f3f4f6; color:#4b5563; }
    .seg-badge.cancelado::before  { background:#9ca3af; }

    /* Timeline */
    .seg-timeline { padding: 24px 24px 16px; border-bottom: 0.5px solid #f0e0e2; }
    .seg-timeline-title {
        font-size: 11px; font-weight: 500; letter-spacing: 0.12em;
        text-transform: uppercase; color: var(--muted); margin-bottom: 20px;
    }
    .seg-timeline-steps {
        display: flex; align-items: center; position: relative; margin-bottom: 8px;
    }
    .seg-step {
        display: flex; flex-direction: column; align-items: center;
        flex: 1; position: relative; z-index: 1;
    }
    .seg-step-dot {
        width: 36px; height: 36px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px; margin-bottom: 8px; border: 2px solid #f0dde0;
        background: #fff; transition: all 0.3s;
    }
    .seg-step.done   .seg-step-dot { background: var(--ink); border-color: var(--ink); color: #fff; }
    .seg-step.active .seg-step-dot {
        background: var(--rose-dark); border-color: var(--rose-dark); color: #fff;
        box-shadow: 0 0 0 5px rgba(196,122,130,0.2);
    }
    .seg-step.pending .seg-step-dot { background: #fdf8f8; border-color: #f0dde0; color: #ccc; }
    .seg-step-label { font-size: 12px; font-weight: 500; color: var(--muted); text-align: center; }
    .seg-step.done   .seg-step-label { color: var(--ink); }
    .seg-step.active .seg-step-label { color: var(--rose-dark); font-weight: 600; }
    .seg-step-line { flex:1; height:2px; background:#f0dde0; margin-bottom:28px; transition:background 0.3s; }
    .seg-step-line.done { background: var(--ink); }

    /* Productos */
    .seg-productos { padding: 18px 24px 20px; }
    .seg-prod-title {
        font-size: 11px; font-weight: 500; letter-spacing: 0.12em;
        text-transform: uppercase; color: var(--muted); margin-bottom: 14px;
    }
    .seg-prod-item {
        display: flex; align-items: center; gap: 14px;
        padding: 10px 0; border-bottom: 0.5px solid #fdf0f1;
    }
    .seg-prod-item:last-child { border-bottom: none; }
    .seg-prod-img { width: 52px; height: 52px; border-radius: 10px; object-fit: cover; border: 0.5px solid #f0e0e2; }
    .seg-prod-info { flex: 1; }
    .seg-prod-name { font-size: 13px; font-weight: 500; color: var(--ink); }
    .seg-prod-qty  { font-size: 12px; color: var(--muted); margin-top: 2px; }
    .seg-prod-price {
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px; font-weight: 600; color: var(--ink);
    }

    /* Total row */
    .seg-total-row {
        display: flex; justify-content: flex-end; align-items: center;
        gap: 12px; padding: 14px 24px;
        border-top: 0.5px solid #f0e0e2; background: #fdf8f8;
    }
    .seg-total-label { font-size: 13px; color: var(--muted); }
    .seg-total-val {
        font-family: 'Cormorant Garamond', serif;
        font-size: 26px; font-weight: 600; color: var(--ink);
    }

    /* Panel de gestión de estado */
    .seg-actions {
        background: #fff; border-radius: 16px; border: 0.5px solid #f0e0e2;
        padding: 20px 24px;
    }
    .seg-actions-title {
        font-size: 11px; font-weight: 500; letter-spacing: 0.12em;
        text-transform: uppercase; color: var(--muted); margin-bottom: 16px;
    }
    .seg-estado-form { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
    .seg-select {
        flex: 1; min-width: 180px; padding: 10px 14px;
        border: 1.5px solid #f0dde0; border-radius: 10px;
        font-size: 13px; color: var(--ink); background: #fdf8f8; outline: none;
    }
    .seg-select:focus { border-color: var(--rose); }
    .seg-btn-save {
        padding: 10px 22px; background: var(--ink); color: #fff;
        border: none; border-radius: 10px; font-size: 13px; font-weight: 500;
        cursor: pointer; transition: opacity 0.2s; white-space: nowrap;
    }
    .seg-btn-save:hover { opacity: 0.85; }
    .seg-locked {
        display: flex; align-items: center; gap: 8px;
        font-size: 13px; color: var(--muted);
        background: #fdf8f8; border-radius: 10px; padding: 10px 16px;
    }

    /* Alert */
    .seg-alert {
        padding: 12px 16px; border-radius: 10px; font-size: 13px;
        margin-bottom: 16px; display: flex; align-items: center; gap: 8px;
    }
    .seg-alert.success { background: #f0faf4; color: #1a5c38; border: 1px solid #b8dfc9; }
    .seg-alert.error   { background: #fff0f0; color: #842029; border: 1px solid #f5c6cb; }
</style>
@endpush

@section('contenido')
<div class="app-content">
    <div class="container-fluid">
        <div class="seg-page">

            {{-- Volver --}}
            <a href="{{ route('perfil.pedidos') }}" class="seg-back">
                <i class="bi bi-arrow-left"></i> Volver a todos los pedidos
            </a>

            {{-- Header --}}
            <div class="seg-header">
                <div>
                    <h1 class="seg-title">Seguimiento del pedido #{{ $pedido->id }}</h1>
                    <p class="seg-subtitle">Vista de seguimiento en tiempo real del cliente</p>
                </div>
            </div>

            {{-- Alertas --}}
            @if(session('mensaje'))
                <div class="seg-alert success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('mensaje') }}
                </div>
            @endif
            @if(session('error'))
                <div class="seg-alert error">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                </div>
            @endif

            {{-- Card del pedido --}}
            @php
                $pasos = ['pendiente','procesando','enviado','entregado'];
                $cancelado = in_array($pedido->estado, ['anulado','cancelado']);
                $idxActual = array_search($pedido->estado, $pasos);
            @endphp

            <div class="seg-card">

                {{-- Cabecera --}}
                <div class="seg-ped-header">
                    <div>
                        <div class="seg-ped-id">Pedido #{{ $pedido->id }}</div>
                        <div class="seg-ped-date">{{ $pedido->created_at->format('d \d\e F \d\e Y') }}</div>
                    </div>
                    <div class="seg-ped-right">
                        <span class="seg-badge {{ $pedido->estado }}">{{ ucfirst($pedido->estado) }}</span>
                        <div class="seg-ped-total">{{ moneda($pedido->total) }}</div>
                    </div>
                </div>

                {{-- Usuario --}}
                <div class="seg-user">
                    <div class="seg-user-avatar">
                        {{ strtoupper(substr($pedido->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="seg-user-name">{{ $pedido->user->name }}</div>
                        <div class="seg-user-email">{{ $pedido->user->email }}</div>
                    </div>
                </div>

                {{-- Timeline --}}
                <div class="seg-timeline">
                    <p class="seg-timeline-title">Seguimiento del envío</p>

                    @if($cancelado)
                        <div style="display:flex;align-items:center;gap:10px;padding:12px 16px;background:#fff0f0;border-radius:10px;font-size:13px;color:#991b1b;">
                            <i class="bi bi-x-circle-fill" style="font-size:18px;"></i>
                            <span>Este pedido fue <strong>{{ $pedido->estado }}</strong>.</span>
                        </div>
                    @else
                        <div class="seg-timeline-steps">
                            @foreach($pasos as $i => $paso)
                                @php
                                    if($idxActual === false)  $stepClass = 'pending';
                                    elseif($i < $idxActual)  $stepClass = 'done';
                                    elseif($i === $idxActual) $stepClass = 'active';
                                    else                      $stepClass = 'pending';
                                    $iconos = ['pendiente'=>'bi-clock','procesando'=>'bi-box-seam','enviado'=>'bi-truck','entregado'=>'bi-check2-circle'];
                                @endphp
                                <div class="seg-step {{ $stepClass }}">
                                    <div class="seg-step-dot">
                                        <i class="bi {{ $iconos[$paso] }}"></i>
                                    </div>
                                    <span class="seg-step-label">{{ ucfirst($paso) }}</span>
                                </div>
                                @if(!$loop->last)
                                    <div class="seg-step-line {{ $i < $idxActual ? 'done' : '' }}"></div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Productos --}}
                <div class="seg-productos">
                    <p class="seg-prod-title">Productos</p>
                    @foreach($pedido->detalles as $detalle)
                    <div class="seg-prod-item">
                        @if($detalle->producto && $detalle->producto->imagen)
                            <img src="{{ asset('uploads/productos/' . $detalle->producto->imagen) }}"
                                 class="seg-prod-img" alt="{{ $detalle->producto->nombre }}">
                        @else
                            <div style="width:52px;height:52px;border-radius:10px;background:#f5dde0;display:flex;align-items:center;justify-content:center;font-size:22px;">👟</div>
                        @endif
                        <div class="seg-prod-info">
                            <div class="seg-prod-name">{{ $detalle->producto->nombre ?? 'Producto eliminado' }}</div>
                            <div class="seg-prod-qty">Cantidad: {{ $detalle->cantidad }}</div>
                        </div>
                        <div class="seg-prod-price">{{ moneda($detalle->precio * $detalle->cantidad) }}</div>
                    </div>
                    @endforeach
                </div>

                {{-- Total --}}
                <div class="seg-total-row">
                    <span class="seg-total-label">Total del pedido</span>
                    <span class="seg-total-val">{{ moneda($pedido->total) }}</span>
                </div>

            </div>{{-- /seg-card --}}

            {{-- Panel gestión de estado (solo admin) --}}
            <div class="seg-actions">
                <p class="seg-actions-title">
                    <i class="bi bi-sliders me-1"></i> Gestionar estado del pedido
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
                    $opciones = $flujo[$pedido->estado] ?? [];
                @endphp

                @if(count($opciones))
                    <form action="{{ route('pedidos.cambiar.estado', $pedido->id) }}" method="POST"
                          class="seg-estado-form">
                        @csrf @method('PATCH')
                        <input type="hidden" name="_redirect" value="{{ route('pedidos.seguimiento', $pedido->id) }}">
                        <select name="estado" class="seg-select">
                            @foreach($opciones as $val => $label)
                                <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="seg-btn-save">
                            <i class="bi bi-check2 me-1"></i> Guardar cambio
                        </button>
                    </form>
                    <p style="font-size:11px;color:#aaa;margin-top:10px;">
                        <i class="bi bi-bell me-1"></i>
                        Se enviará una notificación por correo al cliente al guardar.
                    </p>
                @else
                    <div class="seg-locked">
                        <i class="bi bi-lock" style="font-size:18px;"></i>
                        Este pedido ya no puede cambiar de estado (<strong>{{ ucfirst($pedido->estado) }}</strong>).
                    </div>
                @endif
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
