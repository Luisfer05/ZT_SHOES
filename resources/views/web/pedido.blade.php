@extends('web.app')
@section('titulo', 'ZT|SHOES — Mi carrito')

@push('estilos')
<style>
    :root {
        --rose:       #e8b4b8;
        --rose-light: #f5dde0;
        --rose-dark:  #c47a82;
        --nude:       #f0e6e0;
        --ink:        #1a1212;
        --muted:      #7a6060;
    }

    .cart-page {
        background: #fdf8f8;
        min-height: calc(100vh - 64px);
        padding: 40px 64px 64px;
    }

    /* ── Header ── */
    .cart-header { margin-bottom: 32px; }
    .cart-eyebrow {
        font-size: 11px; font-weight: 500;
        letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--rose-dark); margin-bottom: 6px;
    }
    .cart-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 38px; font-weight: 300; color: var(--ink);
    }
    .cart-title span { font-style: italic; color: var(--rose-dark); }

    /* Breadcrumb */
    .cart-breadcrumb {
        font-size: 12px; color: var(--muted);
        display: flex; align-items: center; gap: 8px;
        margin-bottom: 28px;
    }
    .cart-breadcrumb a { color: var(--muted); text-decoration: none; }
    .cart-breadcrumb a:hover { color: var(--ink); }
    .cart-breadcrumb span { color: var(--rose-dark); }

    /* ── Layout ── */
    .cart-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        align-items: start;
    }

    /* ── Card base ── */
    .cart-card {
        background: #fff;
        border-radius: 16px;
        border: 0.5px solid #f0e0e2;
        overflow: hidden;
    }

    .cart-card-header {
        padding: 16px 24px;
        border-bottom: 0.5px solid #f0e0e2;
        display: flex; align-items: center; justify-content: space-between;
    }
    .cart-card-header h2 {
        font-size: 14px; font-weight: 600; color: var(--ink); margin: 0;
    }
    .cart-count-pill {
        background: var(--rose-light); color: var(--rose-dark);
        font-size: 12px; font-weight: 500;
        padding: 3px 10px; border-radius: 20px;
    }

    /* ── Items ── */
    .cart-items { padding: 0 24px; }

    .cart-item {
        display: grid;
        grid-template-columns: 80px 1fr auto auto auto;
        align-items: center;
        gap: 16px;
        padding: 20px 0;
        border-bottom: 0.5px solid #fdf0f1;
    }
    .cart-item:last-child { border-bottom: none; }

    .cart-item-img {
        width: 80px; height: 80px; border-radius: 10px;
        overflow: hidden; background: var(--rose-light);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .cart-item-img img { width: 100%; height: 100%; object-fit: cover; }

    .cart-item-info {}
    .cart-item-name {
        font-size: 14px; font-weight: 500; color: var(--ink); margin-bottom: 4px;
    }
    .cart-item-price {
        font-size: 13px; color: var(--muted);
    }

    .cart-item-unit-price {
        font-family: 'Cormorant Garamond', serif;
        font-size: 18px; font-weight: 600; color: var(--ink);
        white-space: nowrap;
    }

    /* Contador cantidad */
    .cart-qty {
        display: flex; align-items: center; gap: 0;
        border: 1.5px solid #f0dde0; border-radius: 10px;
        overflow: hidden;
    }
    .cart-qty-btn {
        width: 34px; height: 34px;
        background: #fdf8f8; border: none;
        color: var(--ink); font-size: 16px; font-weight: 500;
        cursor: pointer; transition: background 0.15s;
        display: flex; align-items: center; justify-content: center;
        text-decoration: none;
    }
    .cart-qty-btn:hover { background: var(--rose-light); color: var(--ink); }
    .cart-qty-num {
        width: 36px; text-align: center;
        font-size: 14px; font-weight: 500; color: var(--ink);
        border-left: 1px solid #f0dde0; border-right: 1px solid #f0dde0;
        line-height: 34px;
    }

    .cart-item-subtotal {
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px; font-weight: 600; color: var(--ink);
        white-space: nowrap; text-align: right;
    }

    .cart-item-delete {
        width: 32px; height: 32px; border-radius: 8px;
        background: #fff0f0; border: none; color: #c47a82;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 15px; transition: all 0.15s;
        text-decoration: none;
    }
    .cart-item-delete:hover { background: #ffd7d7; color: #a03030; }

    /* Footer del card */
    .cart-card-footer {
        padding: 14px 24px;
        border-top: 0.5px solid #f0e0e2;
        display: flex; justify-content: flex-end;
    }
    .cart-clear-btn {
        font-size: 12px; color: var(--muted);
        text-decoration: none; display: flex; align-items: center; gap: 6px;
        transition: color 0.2s;
    }
    .cart-clear-btn:hover { color: #c47a82; }

    /* ── Empty state ── */
    .cart-empty {
        text-align: center; padding: 56px 32px;
    }
    .cart-empty-icon { font-size: 52px; margin-bottom: 16px; }
    .cart-empty h3 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 26px; font-weight: 300; color: var(--ink); margin-bottom: 8px;
    }
    .cart-empty p { font-size: 14px; color: var(--muted); margin-bottom: 24px; }

    /* ── Resumen ── */
    .cart-summary { position: sticky; top: 84px; }

    .summary-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 12px 0; border-bottom: 0.5px solid #fdf0f1;
        font-size: 13px; color: var(--muted);
    }
    .summary-row:last-of-type { border-bottom: none; }
    .summary-row strong { color: var(--ink); }

    .summary-total {
        display: flex; justify-content: space-between; align-items: center;
        padding: 16px 0 20px;
        border-top: 1.5px solid #f0e0e2;
        margin-top: 4px;
    }
    .summary-total-label {
        font-size: 14px; font-weight: 600; color: var(--ink);
    }
    .summary-total-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px; font-weight: 600; color: var(--ink);
    }

    .btn-checkout {
        width: 100%; padding: 14px;
        background: var(--ink); color: #fff;
        border: none; border-radius: 30px;
        font-size: 14px; font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        letter-spacing: 0.05em; cursor: pointer;
        transition: opacity 0.2s; margin-bottom: 12px;
    }
    .btn-checkout:hover { opacity: 0.82; }
    .btn-checkout:disabled { opacity: 0.4; cursor: not-allowed; }

    .btn-continue {
        display: block; text-align: center;
        padding: 12px; background: transparent;
        border: 1.5px solid rgba(26,18,18,0.18); border-radius: 30px;
        font-size: 13px; color: var(--ink); text-decoration: none;
        transition: all 0.2s; font-family: 'DM Sans', sans-serif;
    }
    .btn-continue:hover { background: var(--nude); color: var(--ink); border-color: rgba(26,18,18,0.3); }

    /* Login notice */
    .cart-login-notice {
        background: var(--rose-light); border-radius: 10px;
        padding: 12px 16px; margin-bottom: 16px;
        font-size: 13px; color: var(--muted); text-align: center;
    }
    .cart-login-notice a { color: var(--rose-dark); font-weight: 500; text-decoration: none; }
    .cart-login-notice a:hover { text-decoration: underline; }

    /* Alertas */
    .cart-alert {
        border-radius: 10px; padding: 12px 16px;
        font-size: 13px; margin: 0 24px 16px;
        display: flex; align-items: center; gap: 8px;
    }
    .cart-alert.success { background: #f0faf4; color: #1a5c38; }
    .cart-alert.error   { background: #fff0f0; color: #842029; }

    /* ── Responsive ── */
    @media (max-width: 960px) {
        .cart-layout { grid-template-columns: 1fr; }
        .cart-summary { position: static; }
        .cart-page { padding: 24px 20px 48px; }
    }
    @media (max-width: 600px) {
        .cart-item { grid-template-columns: 64px 1fr; grid-template-rows: auto auto; gap: 10px; }
        .cart-item-unit-price { display: none; }
        .cart-item-subtotal { font-size: 16px; }
        .cart-title { font-size: 28px; }
    }
</style>
@endpush

@section('contenido')
<div class="cart-page">

    {{-- Breadcrumb --}}
    <div class="cart-breadcrumb">
        <a href="{{ route('web.home') }}">Inicio</a>
        <span>›</span>
        <a href="{{ route('tienda') }}">Tienda</a>
        <span>›</span>
        <span style="color:var(--ink); font-weight:500;">Mi carrito</span>
    </div>

    {{-- Header --}}
    <div class="cart-header">
        <p class="cart-eyebrow">Tu selección</p>
        <h1 class="cart-title">Mi <span>carrito</span></h1>
    </div>

    <div class="cart-layout">

        {{-- ── Items ── --}}
        <div>
            <div class="cart-card">
                <div class="cart-card-header">
                    <h2><i class="bi bi-bag me-2" style="color:var(--rose-dark)"></i>Productos</h2>
                    <span class="cart-count-pill">
                        {{ array_sum(array_column($carrito, 'cantidad')) }}
                        {{ array_sum(array_column($carrito, 'cantidad')) === 1 ? 'item' : 'items' }}
                    </span>
                </div>

                {{-- Alertas --}}
                @if(session('mensaje'))
                    <div class="cart-alert success">
                        <i class="bi bi-check-circle-fill"></i> {{ session('mensaje') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="cart-alert error">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                    </div>
                @endif

                @if(count($carrito) > 0)
                    <div class="cart-items">
                        @foreach($carrito as $id => $item)
                        <div class="cart-item">

                            {{-- Imagen --}}
                            <div class="cart-item-img">
                                @if(!empty($item['imagen']))
                                    <img src="{{ asset('uploads/productos/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}">
                                @else
                                    <span style="font-size:28px;">👟</span>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="cart-item-info">
                                <div class="cart-item-name">{{ $item['nombre'] }}</div>
                                <div class="cart-item-price">{{ moneda($item['precio']) }} c/u</div>
                            </div>

                            {{-- Precio unitario --}}
                            <div class="cart-item-unit-price">
                                {{ moneda($item['precio']) }}
                            </div>

                            {{-- Cantidad --}}
                            <div class="cart-qty">
                                <a href="{{ route('carrito.restar', ['producto_id' => $id]) }}" class="cart-qty-btn">−</a>
                                <span class="cart-qty-num">{{ $item['cantidad'] }}</span>
                                <a href="{{ route('carrito.sumar', ['producto_id' => $id]) }}" class="cart-qty-btn">+</a>
                            </div>

                            {{-- Subtotal --}}
                            <div class="cart-item-subtotal">
                                {{ moneda($item['precio'] * $item['cantidad']) }}
                            </div>

                            {{-- Eliminar --}}
                            <a href="{{ route('carrito.eliminar', $id) }}" class="cart-item-delete" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </a>

                        </div>
                        @endforeach
                    </div>

                    <div class="cart-card-footer">
                        <a href="{{ route('carrito.vaciar') }}" class="cart-clear-btn">
                            <i class="bi bi-x-circle"></i> Vaciar carrito
                        </a>
                    </div>

                @else
                    <div class="cart-empty">
                        <div class="cart-empty-icon">🛒</div>
                        <h3>Tu carrito está vacío</h3>
                        <p>Aún no has agregado ningún producto.</p>
                        <a href="{{ route('tienda') }}" class="btn-continue" style="display:inline-block; width:auto; padding:12px 28px;">
                            Ir a la tienda
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- ── Resumen ── --}}
        <div class="cart-summary">
            <div class="cart-card">
                <div class="cart-card-header">
                    <h2><i class="bi bi-receipt me-2" style="color:var(--rose-dark)"></i>Resumen</h2>
                </div>
                <div style="padding: 4px 24px 8px;">

                    @php
                        $subtotal = collect($carrito)->sum(fn($i) => $i['precio'] * $i['cantidad']);
                        $items    = array_sum(array_column($carrito, 'cantidad'));
                    @endphp

                    <div class="summary-row">
                        <span>Subtotal ({{ $items }} items)</span>
                        <strong>{{ moneda($subtotal) }}</strong>
                    </div>
                    <div class="summary-row">
                        <span>Envío</span>
                        <strong style="color:{{ $subtotal >= 150 ? '#2d9e60' : 'var(--ink)' }}">
                            {{ $subtotal >= 150 ? 'Gratis' : moneda(10) }}
                        </strong>
                    </div>

                    @php $total = $subtotal + ($subtotal >= 150 ? 0 : 10); @endphp

                    <div class="summary-total">
                        <span class="summary-total-label">Total</span>
                        <span class="summary-total-num">{{ moneda($total) }}</span>
                    </div>

                    @guest
                        <div class="cart-login-notice">
                            <a href="{{ route('login') }}">Inicia sesión</a> para realizar tu pedido
                        </div>
                        <button class="btn-checkout" disabled>Realizar pedido</button>
                    @else
                        @if(count($carrito) > 0)
<<<<<<< HEAD
                            {{-- Dirección de envío --}}
                            <div style="margin-bottom:16px;">
                                <p style="font-size:11px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--rose-dark);margin-bottom:12px;">
                                    <i class="bi bi-geo-alt me-1"></i> Dirección de envío
                                </p>

                                @if($errors->any())
                                    <div class="cart-alert error" style="margin:0 0 12px;">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        {{ $errors->first() }}
                                    </div>
                                @endif

                                <form action="{{ route('pedido.realizar') }}" method="POST" id="form-pedido">
                                @csrf

                                <input type="text" name="direccion" placeholder="Dirección *"
                                    value="{{ old('direccion') }}"
                                    style="width:100%;padding:10px 12px;border:1.5px solid #f0dde0;border-radius:10px;font-size:13px;color:var(--ink);background:#fdf8f8;margin-bottom:8px;box-sizing:border-box;outline:none;font-family:inherit;"
                                    onfocus="this.style.borderColor='var(--rose-dark)'"
                                    onblur="this.style.borderColor='#f0dde0'"
                                    required>

                                <input type="text" name="ciudad" placeholder="Ciudad *"
                                    value="{{ old('ciudad') }}"
                                    style="width:100%;padding:10px 12px;border:1.5px solid #f0dde0;border-radius:10px;font-size:13px;color:var(--ink);background:#fdf8f8;margin-bottom:8px;box-sizing:border-box;outline:none;font-family:inherit;"
                                    onfocus="this.style.borderColor='var(--rose-dark)'"
                                    onblur="this.style.borderColor='#f0dde0'"
                                    required>

                                <input type="text" name="telefono" placeholder="Teléfono (opcional)"
                                    value="{{ old('telefono') }}"
                                    style="width:100%;padding:10px 12px;border:1.5px solid #f0dde0;border-radius:10px;font-size:13px;color:var(--ink);background:#fdf8f8;margin-bottom:8px;box-sizing:border-box;outline:none;font-family:inherit;"
                                    onfocus="this.style.borderColor='var(--rose-dark)'"
                                    onblur="this.style.borderColor='#f0dde0'">

                                <textarea name="notas" placeholder="Notas adicionales (opcional)" rows="2"
                                    style="width:100%;padding:10px 12px;border:1.5px solid #f0dde0;border-radius:10px;font-size:13px;color:var(--ink);background:#fdf8f8;margin-bottom:12px;box-sizing:border-box;outline:none;font-family:inherit;resize:none;"
                                    onfocus="this.style.borderColor='var(--rose-dark)'"
                                    onblur="this.style.borderColor='#f0dde0'">{{ old('notas') }}</textarea>

                                <button type="submit" class="btn-checkout">
                                    <i class="bi bi-credit-card me-2"></i>Realizar pedido
                                </button>
                                </form>
                            </div>
=======
                            <form action="{{ route('pedido.realizar') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-checkout">
                                    <i class="bi bi-credit-card me-2"></i>Realizar pedido
                                </button>
                            </form>
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
                        @else
                            <button class="btn-checkout" disabled>Realizar pedido</button>
                        @endif
                    @endguest

                    <a href="{{ route('tienda') }}" class="btn-continue">
                        ← Continuar comprando
                    </a>

                </div>
            </div>

            {{-- Info envío --}}
            @if($subtotal > 0 && $subtotal < 150)
            <div style="margin-top:12px; background:var(--rose-light); border-radius:12px; padding:12px 16px; font-size:12px; color:var(--muted); text-align:center;">
                <i class="bi bi-truck" style="color:var(--rose-dark);"></i>
                Te faltan <strong style="color:var(--ink)">{{ moneda(150 - $subtotal) }}</strong>
                para obtener <strong style="color:var(--rose-dark)">envío gratis</strong>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection