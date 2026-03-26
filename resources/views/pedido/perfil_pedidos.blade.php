@extends('web.app')
@section('titulo', 'ZT|SHOES — Mis pedidos')

@push('estilos')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
    :root {
        --rose: #e8b4b8; --rose-light: #f5dde0;
        --rose-dark: #c47a82; --nude: #f0e6e0;
        --ink: #1a1212; --muted: #7a6060;
    }

    .mis-page {
        background: #fdf8f8;
        min-height: calc(100vh - 64px);
        padding: 40px 48px 64px;
        font-family: 'DM Sans', sans-serif;
    }

    .mis-layout {
        max-width: 1000px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 28px;
        align-items: start;
    }
    @media (max-width: 768px) {
        .mis-page { padding: 24px 16px 48px; }
        .mis-layout { grid-template-columns: 1fr; }
        .mis-sidebar { display: flex; gap: 8px; flex-wrap: wrap; }
    }

    /* ── Sidebar ── */
    .mis-sidebar {
        background: #fff;
        border: 0.5px solid #f0e0e2;
        border-radius: 16px;
        overflow: hidden;
        position: sticky;
        top: 80px;
    }

    .mis-sidebar-top {
        padding: 20px 16px 16px;
        border-bottom: 0.5px solid #f5eaea;
        display: flex; flex-direction: column;
        align-items: center; gap: 8px; text-align: center;
    }
    .mis-sb-avatar {
        width: 56px; height: 56px; border-radius: 50%;
        background: linear-gradient(135deg, #f5dde0, #e8b4b8);
        display: flex; align-items: center; justify-content: center;
        font-family: Georgia, serif; font-size: 22px; font-weight: 600;
        color: #c47a82;
        box-shadow: 0 0 0 3px rgba(232,180,184,0.35);
    }
    .mis-sb-name  { font-size: 13px; font-weight: 600; color: var(--ink); margin: 0; }
    .mis-sb-email { font-size: 11px; color: #aaa; margin: 0; }

    .mis-sb-nav { padding: 8px; }
    .mis-sb-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 10px;
        font-size: 13px; color: rgba(26,18,18,0.55);
        text-decoration: none; transition: all 0.15s;
    }
    .mis-sb-item:hover { background: #fdf8f8; color: var(--ink); }
    .mis-sb-item.active { background: rgba(232,180,184,0.14); color: var(--rose-dark); font-weight: 500; }
    .mis-sb-icon { width: 15px; height: 15px; flex-shrink: 0; opacity: 0.6; }
    .mis-sb-item.active .mis-sb-icon,
    .mis-sb-item:hover .mis-sb-icon { opacity: 1; }
    .mis-sb-divider { height: 0.5px; background: #f5eaea; margin: 6px 0; }
    .mis-sb-item.danger { color: #dc2626; }
    .mis-sb-item.danger:hover { background: #fff0f0; }

    /* ── Contenido ── */
    .mis-content {}

    .mis-header { margin-bottom: 24px; }
    .mis-eyebrow {
        font-size: 11px; font-weight: 500; letter-spacing: 0.2em;
        text-transform: uppercase; color: var(--rose-dark); margin-bottom: 6px;
    }
    .mis-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 34px; font-weight: 300; color: var(--ink);
    }
    .mis-title span { font-style: italic; color: var(--rose-dark); }

    /* Notificaciones */
    .mis-notis { margin-bottom: 20px; }
    .mis-noti {
        display: flex; align-items: flex-start; gap: 12px;
        background: #fff; border: 0.5px solid #f0e0e2;
        border-left: 3px solid var(--rose-dark);
        border-radius: 12px; padding: 14px 16px;
        margin-bottom: 10px; font-size: 13px;
        animation: slideIn 0.4s ease both;
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .mis-noti-icon { font-size: 18px; flex-shrink: 0; margin-top: 1px; }
    .mis-noti-body { flex: 1; }
    .mis-noti-msg  { color: var(--ink); margin-bottom: 3px; }
    .mis-noti-meta { font-size: 11px; color: var(--muted); }
    .mis-noti-close {
        background: none; border: none; color: var(--muted);
        cursor: pointer; font-size: 16px; padding: 0; line-height: 1;
    }

    .mis-alert {
        border-radius: 10px; padding: 12px 16px; font-size: 13px;
        margin-bottom: 20px; display: flex; align-items: center; gap: 8px;
    }
    .mis-alert.success { background: #f0faf4; color: #1a5c38; border: 1px solid #b8dfc9; }
    .mis-alert.error   { background: #fff0f0; color: #842029; border: 1px solid #f5c6cb; }

    /* Pedido card */
    .mis-pedido {
        background: #fff; border-radius: 16px;
        border: 0.5px solid #f0e0e2; margin-bottom: 16px;
        overflow: hidden;
    }
    .mis-pedido-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 18px 24px; cursor: pointer; transition: background 0.15s;
    }
    .mis-pedido-header:hover { background: #fdf8f8; }
    .mis-pedido-id { font-size: 13px; font-weight: 600; color: var(--ink); }
    .mis-pedido-fecha { font-size: 12px; color: var(--muted); margin-top: 2px; }
    .mis-pedido-total {
        font-family: 'Cormorant Garamond', serif;
        font-size: 22px; font-weight: 600; color: var(--ink);
    }
    .mis-pedido-right { display: flex; align-items: center; gap: 16px; }
    .mis-chevron { font-size: 14px; color: var(--muted); transition: transform 0.3s; }
    .mis-pedido-header.open .mis-chevron { transform: rotate(180deg); }

    /* Badge estado */
    .mis-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 12px; border-radius: 20px;
        font-size: 11px; font-weight: 500;
    }
    .mis-badge::before {
        content: ''; width: 6px; height: 6px;
        border-radius: 50%; display: inline-block;
    }
    .mis-badge.pendiente  { background: #fef3c7; color: #92400e; }
    .mis-badge.pendiente::before  { background: #d97706; }
    .mis-badge.procesando { background: #eff6ff; color: #1e40af; }
    .mis-badge.procesando::before { background: #3b82f6; }
    .mis-badge.enviado    { background: #f0fdf4; color: #166534; }
    .mis-badge.enviado::before    { background: #22c55e; }
    .mis-badge.entregado  { background: #f0faf4; color: #1a5c38; }
    .mis-badge.entregado::before  { background: #059669; }
    .mis-badge.anulado    { background: #fff0f0; color: #991b1b; }
    .mis-badge.anulado::before    { background: #ef4444; }
    .mis-badge.cancelado  { background: #f3f4f6; color: #4b5563; }
    .mis-badge.cancelado::before  { background: #9ca3af; }

    .mis-pedido-body { display: none; border-top: 0.5px solid #f0e0e2; }
    .mis-pedido-body.open { display: block; }

    /* Timeline */
    .mis-timeline { padding: 24px 24px 8px; border-bottom: 0.5px solid #f0e0e2; }
    .mis-timeline-title {
        font-size: 11px; font-weight: 500; letter-spacing: 0.12em;
        text-transform: uppercase; color: var(--muted); margin-bottom: 20px;
    }
    .mis-timeline-steps { display: flex; align-items: center; position: relative; margin-bottom: 8px; }
    .mis-step { display: flex; flex-direction: column; align-items: center; flex: 1; position: relative; z-index: 1; }
    .mis-step-dot {
        width: 32px; height: 32px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 14px; margin-bottom: 8px; border: 2px solid #f0dde0;
        background: #fff; transition: all 0.3s;
    }
    .mis-step.done   .mis-step-dot { background: var(--ink); border-color: var(--ink); color: #fff; }
    .mis-step.active .mis-step-dot { background: var(--rose-dark); border-color: var(--rose-dark); color: #fff; box-shadow: 0 0 0 4px rgba(196,122,130,0.2); }
    .mis-step.pending .mis-step-dot { background: #fdf8f8; border-color: #f0dde0; color: #ccc; }
    .mis-step-label { font-size: 11px; font-weight: 500; color: var(--muted); text-align: center; }
    .mis-step.done   .mis-step-label { color: var(--ink); }
    .mis-step.active .mis-step-label { color: var(--rose-dark); font-weight: 600; }
    .mis-step-line { flex: 1; height: 2px; background: #f0dde0; margin-bottom: 26px; }
    .mis-step-line.done { background: var(--ink); }

    /* Productos */
    .mis-productos { padding: 16px 24px 20px; }
    .mis-prod-title {
        font-size: 11px; font-weight: 500; letter-spacing: 0.12em;
        text-transform: uppercase; color: var(--muted); margin-bottom: 14px;
    }
    .mis-prod-item { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 0.5px solid #fdf0f1; }
    .mis-prod-item:last-child { border-bottom: none; }
    .mis-prod-img { width: 48px; height: 48px; border-radius: 10px; background: var(--rose-light); overflow: hidden; flex-shrink: 0; }
    .mis-prod-img img { width: 100%; height: 100%; object-fit: cover; }
    .mis-prod-info { flex: 1; }
    .mis-prod-name { font-size: 13px; font-weight: 500; color: var(--ink); }
    .mis-prod-qty  { font-size: 12px; color: var(--muted); margin-top: 2px; }
    .mis-prod-price { font-family: 'Cormorant Garamond', serif; font-size: 18px; font-weight: 600; color: var(--ink); }

    .mis-pedido-total-row {
        display: flex; justify-content: flex-end; align-items: center;
        gap: 12px; padding: 14px 24px;
        border-top: 0.5px solid #f0e0e2; background: #fdf8f8;
    }
    .mis-pedido-total-label { font-size: 13px; color: var(--muted); }
    .mis-pedido-total-val { font-family: 'Cormorant Garamond', serif; font-size: 24px; font-weight: 600; color: var(--ink); }

    /* Empty */
    .mis-empty {
        text-align: center; padding: 64px 20px;
        background: #fff; border-radius: 16px; border: 0.5px solid #f0e0e2;
    }
    .mis-empty-icon { font-size: 52px; margin-bottom: 16px; }
    .mis-empty h3 { font-family: 'Cormorant Garamond', serif; font-size: 26px; font-weight: 300; color: var(--ink); margin-bottom: 8px; }
    .mis-empty p { font-size: 14px; color: var(--muted); margin-bottom: 24px; }
    .mis-empty-btn {
        padding: 13px 28px; background: var(--ink); color: #fff;
        border-radius: 30px; text-decoration: none; font-size: 13px;
        font-weight: 500; transition: opacity 0.2s; display: inline-block;
    }
    .mis-empty-btn:hover { opacity: 0.82; color: #fff; }
</style>
@endpush

@section('contenido')
<div class="mis-page">
    <div class="mis-layout">

        {{-- ── SIDEBAR ── --}}
        <aside class="mis-sidebar">
            <div class="mis-sidebar-top">
                <div class="mis-sb-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <p class="mis-sb-name">{{ auth()->user()->name }}</p>
                <p class="mis-sb-email">{{ auth()->user()->email }}</p>
            </div>

            <nav class="mis-sb-nav">
                <a href="{{ route('perfil.edit') }}" class="mis-sb-item">
                    <svg class="mis-sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                    Mi perfil
                </a>
                <a href="{{ route('perfil.pedidos') }}" class="mis-sb-item active">
                    <svg class="mis-sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    Mis pedidos
                </a>
                <a href="{{ route('tienda') }}" class="mis-sb-item">
                    <svg class="mis-sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                    Ir a la tienda
                </a>

                <div class="mis-sb-divider"></div>

                <a href="#" class="mis-sb-item danger"
                   onclick="event.preventDefault(); document.getElementById('logout-mis').submit();">
                    <svg class="mis-sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Cerrar sesión
                </a>
                <form id="logout-mis" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </nav>
        </aside>

        {{-- ── CONTENIDO ── --}}
        <div class="mis-content">

            <div class="mis-header">
                <p class="mis-eyebrow">Mi cuenta</p>
                <h1 class="mis-title">Mis <span>pedidos</span></h1>
            </div>

            {{-- Notificaciones --}}
            @php $notis = session()->pull('notificaciones_' . auth()->id(), []); @endphp
            @if(count($notis))
                <div class="mis-notis">
                    @foreach($notis as $noti)
                    <div class="mis-noti">
                        <span class="mis-noti-icon">🔔</span>
                        <div class="mis-noti-body">
                            <div class="mis-noti-msg">{{ $noti['mensaje'] }}</div>
                            <div class="mis-noti-meta">Pedido #{{ $noti['pedido_id'] }} · {{ $noti['fecha'] }}</div>
                        </div>
                        <button class="mis-noti-close" onclick="this.closest('.mis-noti').remove()">×</button>
                    </div>
                    @endforeach
                </div>
            @endif

            @if(session('mensaje'))
                <div class="mis-alert success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('mensaje') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mis-alert error">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                </div>
            @endif

            {{-- Lista de pedidos --}}
            @if($registros->count())

                @foreach($registros as $reg)
                @php
                    $pasos = ['pendiente','procesando','enviado','entregado'];
                    $cancelado = in_array($reg->estado, ['anulado','cancelado']);
                    $idxActual = array_search($reg->estado, $pasos);
                @endphp

                <div class="mis-pedido">
                    <div class="mis-pedido-header" onclick="togglePedido({{ $reg->id }})">
                        <div>
                            <div class="mis-pedido-id">Pedido #{{ $reg->id }}</div>
                            <div class="mis-pedido-fecha">{{ $reg->created_at->format('d \d\e F \d\e Y') }}</div>
                        </div>
                        <div class="mis-pedido-right">
                            <span class="mis-badge {{ $reg->estado }}">{{ ucfirst($reg->estado) }}</span>
                            <div class="mis-pedido-total">{{ moneda($reg->total) }}</div>
                            <i class="bi bi-chevron-down mis-chevron" id="chevron-{{ $reg->id }}"></i>
                        </div>
                    </div>

                    <div class="mis-pedido-body" id="body-{{ $reg->id }}">

                        {{-- Timeline --}}
                        <div class="mis-timeline">
                            <p class="mis-timeline-title">Seguimiento del envío</p>
                            @if($cancelado)
                                <div style="display:flex;align-items:center;gap:10px;padding:12px 16px;background:#fff0f0;border-radius:10px;font-size:13px;color:#991b1b;">
                                    <i class="bi bi-x-circle-fill" style="font-size:18px;"></i>
                                    <span>Este pedido fue <strong>{{ $reg->estado }}</strong>.</span>
                                </div>
                            @else
                                <div class="mis-timeline-steps">
                                    @foreach($pasos as $i => $paso)
                                        @php
                                            if($idxActual === false)  $stepClass = 'pending';
                                            elseif($i < $idxActual)  $stepClass = 'done';
                                            elseif($i === $idxActual) $stepClass = 'active';
                                            else                      $stepClass = 'pending';
                                            $iconos = ['pendiente'=>'bi-clock','procesando'=>'bi-box-seam','enviado'=>'bi-truck','entregado'=>'bi-check2-circle'];
                                        @endphp
                                        <div class="mis-step {{ $stepClass }}">
                                            <div class="mis-step-dot"><i class="bi {{ $iconos[$paso] }}"></i></div>
                                            <span class="mis-step-label">{{ ucfirst($paso) }}</span>
                                        </div>
                                        @if(!$loop->last)
                                            <div class="mis-step-line {{ $i < $idxActual ? 'done' : '' }}"></div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- Productos --}}
                        <div class="mis-productos">
                            <p class="mis-prod-title">Productos</p>
                            @foreach($reg->detalles as $detalle)
                            <div class="mis-prod-item">
                                <div class="mis-prod-img">
                                    @if($detalle->producto && $detalle->producto->imagen)
                                        <img src="{{ asset('uploads/productos/' . $detalle->producto->imagen) }}"
                                             alt="{{ $detalle->producto->nombre ?? '' }}">
                                    @else
                                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:22px;">👟</div>
                                    @endif
                                </div>
                                <div class="mis-prod-info">
                                    <div class="mis-prod-name">{{ $detalle->producto->nombre ?? 'Producto eliminado' }}</div>
                                    <div class="mis-prod-qty">Cantidad: {{ $detalle->cantidad }}</div>
                                </div>
                                <div class="mis-prod-price">{{ moneda($detalle->precio * $detalle->cantidad) }}</div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mis-pedido-total-row">
                            <span class="mis-pedido-total-label">Total del pedido</span>
                            <span class="mis-pedido-total-val">{{ moneda($reg->total) }}</span>
                        </div>

                    </div>
                </div>
                @endforeach

                <div style="margin-top:24px; display:flex; justify-content:center;">
                    {{ $registros->links() }}
                </div>

            @else
                <div class="mis-empty">
                    <div class="mis-empty-icon">🛍️</div>
                    <h3>Aún no tienes pedidos</h3>
                    <p>Cuando realices una compra aparecerá aquí con el seguimiento en tiempo real.</p>
                    <a href="{{ route('tienda') }}" class="mis-empty-btn">Ir a la tienda</a>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePedido(id) {
    const body    = document.getElementById('body-' + id);
    const chevron = document.getElementById('chevron-' + id);
    const header  = chevron.closest('.mis-pedido-header');
    const isOpen  = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    header.classList.toggle('open', !isOpen);
}
</script>
@endpush