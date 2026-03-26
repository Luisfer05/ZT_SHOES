@extends('web.app')
@section('titulo', 'ZT|SHOES — ' . $producto->nombre)

@push('estilos')
<style>
    :root {
        --rose: #e8b4b8; --rose-light: #f5dde0;
        --rose-dark: #c47a82; --nude: #f0e6e0;
        --ink: #1a1212; --muted: #7a6060;
    }
    .item-page { background:#fdf8f8; min-height:calc(100vh - 64px); padding:0 0 64px; }
    .item-breadcrumb {
        padding:14px 64px; background:#fff; border-bottom:0.5px solid #f0e0e2;
        font-size:12px; color:var(--muted); display:flex; align-items:center; gap:8px;
    }
    .item-breadcrumb a { color:var(--muted); text-decoration:none; }
    .item-breadcrumb a:hover { color:var(--ink); }
    .item-breadcrumb span { color:var(--rose-dark); }
    .item-layout {
        display:grid; grid-template-columns:1fr 1fr;
        max-width:1200px; margin:0 auto;
        padding:48px 64px; align-items:start; gap:56px;
    }
    .item-main-img {
        border-radius:20px; overflow:hidden;
        background:linear-gradient(135deg,#f5dde0,#e8b4b8);
        aspect-ratio:1/1; display:flex; align-items:center;
        justify-content:center; position:relative;
    }
    .item-main-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.5s; }
    .item-main-img:hover img { transform:scale(1.04); }
    .item-sku-badge {
        position:absolute; top:16px; left:16px;
        background:rgba(255,255,255,0.9); border-radius:20px; padding:5px 12px;
        font-size:11px; font-weight:500; color:var(--muted); letter-spacing:0.06em;
    }
    .item-eyebrow {
        font-size:11px; font-weight:500; letter-spacing:0.2em;
        text-transform:uppercase; color:var(--rose-dark); margin-bottom:12px;
    }
    .item-name {
        font-family:'Cormorant Garamond',serif;
        font-size:48px; font-weight:300; line-height:1.05;
        color:var(--ink); margin-bottom:20px;
    }
    .item-price-wrap {
        display:flex; align-items:baseline; gap:12px;
        margin-bottom:28px; padding-bottom:28px;
        border-bottom:0.5px solid #f0e0e2;
    }
    .item-price { font-family:'Cormorant Garamond',serif; font-size:36px; font-weight:600; color:var(--ink); }
    .item-price-label { font-size:13px; color:var(--muted); }
    .item-desc-title {
        font-size:12px; font-weight:500; letter-spacing:0.12em;
        text-transform:uppercase; color:var(--muted); margin-bottom:10px;
    }
    .item-desc { font-size:14px; color:var(--muted); line-height:1.8; margin-bottom:32px; }
    .item-features { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:32px; }
    .item-feature { display:flex; align-items:center; gap:8px; font-size:13px; color:var(--muted); }
    .item-feature i { color:var(--rose-dark); font-size:14px; }
    .item-actions { display:flex; gap:12px; align-items:center; margin-bottom:20px; }
    .item-qty-wrap {
        display:flex; align-items:center;
        border:1.5px solid #f0dde0; border-radius:12px; overflow:hidden; flex-shrink:0;
    }
    .item-qty-btn {
        width:40px; height:48px; background:#fdf8f8; border:none;
        color:var(--ink); font-size:18px; cursor:pointer; transition:background 0.15s;
        display:flex; align-items:center; justify-content:center;
    }
    .item-qty-btn:hover { background:var(--rose-light); }
    .item-qty-input {
        width:52px; height:48px; border:none;
        border-left:1px solid #f0dde0; border-right:1px solid #f0dde0;
        text-align:center; font-size:15px; font-weight:500; color:var(--ink);
        background:#fff; outline:none; font-family:'DM Sans',sans-serif;
        -moz-appearance:textfield;
    }
    .item-qty-input::-webkit-outer-spin-button,
    .item-qty-input::-webkit-inner-spin-button { -webkit-appearance:none; }
    .item-add-btn {
        flex:1; padding:14px 28px; background:var(--ink); color:#fff;
        border:none; border-radius:30px; font-size:14px; font-weight:500;
        font-family:'DM Sans',sans-serif; letter-spacing:0.05em; cursor:pointer;
        transition:opacity 0.2s; display:flex; align-items:center; justify-content:center; gap:8px;
    }
    .item-add-btn:hover { opacity:0.82; }
    .item-back-btn {
        padding:14px 20px; background:transparent;
        border:1.5px solid rgba(26,18,18,0.18); border-radius:30px;
        color:var(--ink); text-decoration:none; font-size:13px;
        font-family:'DM Sans',sans-serif; transition:all 0.2s;
        display:flex; align-items:center; gap:6px; white-space:nowrap;
    }
    .item-back-btn:hover { background:var(--nude); }
    .item-alert {
        border-radius:10px; padding:12px 16px; font-size:13px; margin-bottom:16px;
        display:flex; align-items:center; gap:8px;
        background:#f0faf4; color:#1a5c38; border:1px solid #b8dfc9;
    }
    .item-guarantees {
        display:flex; gap:16px; flex-wrap:wrap;
        padding-top:20px; border-top:0.5px solid #f0e0e2; margin-top:8px;
    }
    .item-guarantee { display:flex; align-items:center; gap:6px; font-size:12px; color:var(--muted); }
    .item-guarantee i { color:var(--rose-dark); }
    @media (max-width:900px) {
        .item-layout { grid-template-columns:1fr; padding:24px 20px; gap:32px; }
        .item-name { font-size:36px; }
        .item-breadcrumb { padding:14px 20px; }
    }
</style>
@endpush

@section('contenido')
<div class="item-page">

    <div class="item-breadcrumb">
        <a href="{{ route('web.home') }}">Inicio</a>
        <span>›</span>
        <a href="{{ route('tienda') }}">Tienda</a>
        <span>›</span>
        <span style="color:var(--ink);font-weight:500;">{{ $producto->nombre }}</span>
    </div>

    <div class="item-layout">

        {{-- Imagen --}}
        <div class="item-gallery">
            <div class="item-main-img">
                @if($producto->imagen)
                    <img src="{{ asset('uploads/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                @else
                    <span style="font-size:96px;">👟</span>
                @endif
                <span class="item-sku-badge">SKU: {{ $producto->codigo }}</span>
            </div>
        </div>

        {{-- Info --}}
        <div class="item-info">
            <p class="item-eyebrow">ZT | SHOES</p>
            <h1 class="item-name">{{ $producto->nombre }}</h1>

            <div class="item-price-wrap">
                <span class="item-price">{{ moneda($producto->precio) }}</span>
                <span class="item-price-label">Precio unitario · IVA incluido</span>
            </div>

            @if($producto->descripcion)
                <p class="item-desc-title">Descripción</p>
                <p class="item-desc">{{ $producto->descripcion }}</p>
            @endif

            <div class="item-features">
                <div class="item-feature"><i class="bi bi-patch-check-fill"></i><span>Producto original</span></div>
                <div class="item-feature"><i class="bi bi-arrow-counterclockwise"></i><span>Devolución en 30 días</span></div>
                <div class="item-feature"><i class="bi bi-shield-check"></i><span>Pago seguro</span></div>
                <div class="item-feature"><i class="bi bi-truck"></i><span>Envío a todo el país</span></div>
            </div>

            @if(session('mensaje'))
                <div class="item-alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('mensaje') }}
                </div>
            @endif

            <form action="{{ route('carrito.agregar') }}" method="POST">
                @csrf
                <input type="hidden" name="id"     value="{{ $producto->id }}">
                <input type="hidden" name="nombre" value="{{ $producto->nombre }}">
                <input type="hidden" name="precio" value="{{ $producto->precio }}">
                <input type="hidden" name="imagen" value="{{ $producto->imagen }}">

                <div class="item-actions">
                    <div class="item-qty-wrap">
                        <button type="button" class="item-qty-btn" onclick="cambiarCantidad(-1)">−</button>
                        <input type="number" name="cantidad" id="cantidad" class="item-qty-input" value="1" min="1" max="99">
                        <button type="button" class="item-qty-btn" onclick="cambiarCantidad(1)">+</button>
                    </div>
                    <button type="submit" class="item-add-btn">
                        <i class="bi bi-cart-plus"></i> Agregar al carrito
                    </button>
                    <a href="{{ route('tienda') }}" class="item-back-btn">← Volver</a>
                </div>
            </form>

            <div class="item-guarantees">
                <div class="item-guarantee"><i class="bi bi-credit-card"></i><span>Múltiples métodos de pago</span></div>
                <div class="item-guarantee"><i class="bi bi-headset"></i><span>Soporte al cliente</span></div>
                <div class="item-guarantee"><i class="bi bi-box-seam"></i><span>Empaque protegido</span></div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
function cambiarCantidad(delta) {
    const input = document.getElementById('cantidad');
    input.value = Math.max(1, Math.min(99, parseInt(input.value) + delta));
}
</script>
@endpush