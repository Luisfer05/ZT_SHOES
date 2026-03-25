@extends('web.app')
@section('titulo', 'ZT|SHOES — Tienda')

@push('estilos')
<style>
    /* ══════════════════════════════════════
       BANNER SUPERIOR
    ══════════════════════════════════════ */
    .zt-shop-banner {
        position: relative;
        height: 280px;
        background: linear-gradient(135deg, #f5dde0 0%, #e8b4b8 45%, #d4878f 100%);
        display: flex; align-items: center;
        overflow: hidden;
    }

    .zt-shop-banner-bg {
        position: absolute;
        font-family: 'Cormorant Garamond', serif;
        font-size: 220px; font-weight: 600;
        color: rgba(255,255,255,0.14);
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        white-space: nowrap;
        pointer-events: none; user-select: none;
    }

    .zt-shop-banner-content {
        position: relative; z-index: 2;
        padding: 0 64px;
        animation: ztFadeUp 0.6s ease both;
    }

    @keyframes ztFadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .zt-shop-eyebrow {
        font-size: 11px; font-weight: 500;
        letter-spacing: 0.22em; text-transform: uppercase;
        color: #c47a82; margin-bottom: 12px;
    }

    .zt-shop-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 56px; font-weight: 300;
        line-height: 1.05; color: #1a1212;
    }

    .zt-shop-title em { font-style: italic; color: #c47a82; }

    .zt-shop-sub {
        font-size: 13px; color: #7a6060;
        margin-top: 12px; max-width: 380px; line-height: 1.7;
    }

    /* Breadcrumb */
    .zt-breadcrumb {
        padding: 14px 64px;
        background: #fff;
        border-bottom: 0.5px solid #f0e0e2;
        font-size: 12px; color: #7a6060;
        display: flex; align-items: center; gap: 8px;
    }
    .zt-breadcrumb a { color: #7a6060; text-decoration: none; transition: color 0.2s; }
    .zt-breadcrumb a:hover { color: #1a1212; }
    .zt-breadcrumb span { color: #c47a82; }

    /* ══════════════════════════════════════
       LAYOUT PRINCIPAL
    ══════════════════════════════════════ */
    .zt-shop-layout {
        display: grid;
        grid-template-columns: 240px 1fr;
        min-height: 60vh;
        background: #fdf8f8;
    }

    /* ══════════════════════════════════════
       SIDEBAR FILTROS
    ══════════════════════════════════════ */
    .zt-sidebar {
        background: #fff;
        border-right: 0.5px solid #f0e0e2;
        padding: 32px 24px;
        position: sticky;
        top: 64px;
        height: calc(100vh - 64px);
        overflow-y: auto;
    }

    .zt-sidebar-title {
        font-size: 10px; font-weight: 500;
        letter-spacing: 0.18em; text-transform: uppercase;
        color: #c47a82; margin-bottom: 20px;
    }

    .zt-filter-group { margin-bottom: 28px; }

    .zt-filter-label {
        font-size: 12px; font-weight: 500;
        color: #1a1212; margin-bottom: 12px;
        letter-spacing: 0.03em;
    }

    /* Input búsqueda en sidebar */
    .zt-sidebar-search {
        display: flex; align-items: center; gap: 8px;
        background: #fdf8f8; border: 1.5px solid #f0dde0;
        border-radius: 10px; padding: 0 12px; height: 40px;
        transition: border-color 0.2s;
    }
    .zt-sidebar-search:focus-within { border-color: #e8b4b8; }
    .zt-sidebar-search svg { color: #b08888; flex-shrink: 0; }
    .zt-sidebar-search input {
        background: transparent; border: none; outline: none;
        font-size: 13px; color: #1a1212; width: 100%;
        font-family: 'DM Sans', sans-serif;
    }
    .zt-sidebar-search input::placeholder { color: #b08888; }

    /* Select ordenar */
    .zt-sidebar-select {
        width: 100%; padding: 10px 12px;
        border: 1.5px solid #f0dde0; border-radius: 10px;
        font-size: 13px; font-family: 'DM Sans', sans-serif;
        color: #1a1212; background: #fdf8f8;
        outline: none; cursor: pointer;
        transition: border-color 0.2s; appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23b08888' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 32px;
    }
    .zt-sidebar-select:focus { border-color: #e8b4b8; }

    /* Botón aplicar */
    .zt-sidebar-btn {
        width: 100%; padding: 11px;
        background: #1a1212; color: #fff;
        border: none; border-radius: 10px;
        font-size: 13px; font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer; transition: opacity 0.2s;
        letter-spacing: 0.04em; margin-top: 4px;
    }
    .zt-sidebar-btn:hover { opacity: 0.82; }

    /* Limpiar filtros */
    .zt-sidebar-clear {
        display: block; text-align: center;
        margin-top: 10px; font-size: 12px;
        color: #b08888; text-decoration: none;
        transition: color 0.2s;
    }
    .zt-sidebar-clear:hover { color: #c47a82; }

    .zt-sidebar-divider {
        border: none; border-top: 0.5px solid #f0e0e2;
        margin: 24px 0;
    }

    /* Info rápida sidebar */
    .zt-sidebar-info {
        font-size: 12px; color: #7a6060; line-height: 1.7;
    }
    .zt-sidebar-info strong { color: #1a1212; font-weight: 500; }

    /* ══════════════════════════════════════
       ÁREA DE PRODUCTOS
    ══════════════════════════════════════ */
    .zt-shop-main { padding: 32px 36px; }

    /* Barra superior productos */
    .zt-shop-topbar {
        display: flex; align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 0.5px solid #f0e0e2;
    }

    .zt-shop-count {
        font-size: 13px; color: #7a6060;
    }
    .zt-shop-count strong { color: #1a1212; font-weight: 500; }

    /* Pill de filtro activo */
    .zt-filter-pill {
        display: inline-flex; align-items: center; gap: 6px;
        background: #f5dde0; border-radius: 20px;
        padding: 4px 12px; font-size: 12px; color: #c47a82;
        font-weight: 500;
    }
    .zt-filter-pill a {
        color: #c47a82; text-decoration: none;
        font-size: 14px; line-height: 1;
    }
    .zt-filter-pill a:hover { color: #1a1212; }

    /* Grid productos */
    .zt-products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    /* Card */
    .zt-product-card {
        background: #fff; border-radius: 16px; overflow: hidden;
        border: 0.5px solid #f0e0e2;
        transition: transform 0.22s, box-shadow 0.22s;
        text-decoration: none; color: inherit; display: flex;
        flex-direction: column;
    }
    .zt-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 36px rgba(196,122,130,0.15);
        color: inherit;
    }

    .zt-product-img {
        height: 220px; overflow: hidden;
        background: linear-gradient(135deg, #f5dde0, #e8b4b8);
        display: flex; align-items: center; justify-content: center;
        position: relative;
    }
    .zt-product-img img {
        width: 100%; height: 100%;
        object-fit: cover; transition: transform 0.45s ease;
    }
    .zt-product-card:hover .zt-product-img img { transform: scale(1.06); }

    /* Etiqueta "Nuevo" */
    .zt-product-badge {
        position: absolute; top: 12px; left: 12px;
        background: #1a1212; color: #fff;
        font-size: 10px; font-weight: 500;
        letter-spacing: 0.1em; text-transform: uppercase;
        padding: 4px 10px; border-radius: 20px;
    }

    .zt-product-info { padding: 16px 18px; flex: 1; display: flex; flex-direction: column; }

    .zt-product-name {
        font-size: 14px; font-weight: 500;
        color: #1a1212; margin-bottom: 4px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

    .zt-product-footer {
        display: flex; align-items: center;
        justify-content: space-between;
        margin-top: auto; padding-top: 12px;
    }

    .zt-product-price {
        font-family: 'Cormorant Garamond', serif;
        font-size: 22px; font-weight: 600; color: #1a1212;
    }

    .zt-card-actions { display: flex; gap: 6px; align-items: center; }

    .zt-ver-btn {
        padding: 7px 16px; background: transparent; color: #1a1212;
        border: 1.5px solid rgba(26,18,18,0.2); border-radius: 20px;
        font-size: 12px; font-weight: 500; cursor: pointer;
        font-family: 'DM Sans', sans-serif; transition: all 0.15s;
        text-decoration: none; display: inline-block; white-space: nowrap;
    }
    .zt-ver-btn:hover { background: #1a1212; color: #fff; border-color: #1a1212; }

    .zt-add-btn {
        width: 34px; height: 34px; background: #1a1212; color: #fff;
        border: none; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 22px; line-height: 1;
        transition: background 0.2s; flex-shrink: 0;
    }
    .zt-add-btn:hover { background: #c47a82; }

    /* Empty state */
    .zt-empty {
        grid-column: 1/-1;
        text-align: center; padding: 80px 20px;
    }
    .zt-empty-icon { font-size: 56px; margin-bottom: 16px; }
    .zt-empty h3 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px; font-weight: 300; color: #1a1212; margin-bottom: 8px;
    }
    .zt-empty p { font-size: 14px; color: #7a6060; margin-bottom: 24px; }

    /* ══════════════════════════════════════
       PAGINACIÓN
    ══════════════════════════════════════ */
    .zt-pagination {
        margin-top: 40px;
        display: flex; justify-content: center;
    }
    .zt-pagination .pagination { display: flex; gap: 4px; list-style: none; padding: 0; margin: 0; }
    .zt-pagination .page-link {
        border: 1.5px solid #f0dde0 !important;
        border-radius: 10px !important;
        color: #7a6060 !important;
        font-size: 13px; padding: 8px 16px;
        font-family: 'DM Sans', sans-serif;
        background: #fff !important;
        transition: all 0.15s;
    }
    .zt-pagination .page-link:hover {
        background: #f0e6e0 !important;
        color: #1a1212 !important;
        border-color: #e8b4b8 !important;
    }
    .zt-pagination .page-item.active .page-link {
        background: #1a1212 !important;
        border-color: #1a1212 !important;
        color: #fff !important;
    }
    .zt-pagination .page-item.disabled .page-link { opacity: 0.4; }

    /* ══════════════════════════════════════
       RESPONSIVE
    ══════════════════════════════════════ */
    @media (max-width: 1100px) {
        .zt-products-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 900px) {
        .zt-shop-layout { grid-template-columns: 1fr; }
        .zt-sidebar {
            position: static; height: auto;
            border-right: none; border-bottom: 0.5px solid #f0e0e2;
            padding: 20px 24px;
        }
        .zt-sidebar-form-row {
            display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
        }
        .zt-shop-banner-content { padding: 0 24px; }
        .zt-shop-title { font-size: 38px; }
        .zt-breadcrumb { padding: 14px 24px; }
        .zt-shop-main { padding: 24px 20px; }
    }

    @media (max-width: 560px) {
        .zt-products-grid { grid-template-columns: repeat(2, 1fr); }
        .zt-shop-banner { height: 200px; }
        .zt-shop-title { font-size: 30px; }
        .zt-sidebar-form-row { grid-template-columns: 1fr; }
    }

    @media (max-width: 360px) {
        .zt-products-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('contenido')

{{-- ══ BANNER ══ --}}
<section class="zt-shop-banner">
    <div class="zt-shop-banner-bg">SHOP</div>
    <div class="zt-shop-banner-content">
        <p class="zt-shop-eyebrow">Colección completa</p>
        <h1 class="zt-shop-title">Nuestra <em>tienda</em></h1>
        <p class="zt-shop-sub">Encuentra el par perfecto entre todos nuestros modelos disponibles.</p>
    </div>
</section>

{{-- Breadcrumb --}}
<div class="zt-breadcrumb">
    <a href="{{ route('web.home') }}">Inicio</a>
    <span>›</span>
    <span style="color:#1a1212; font-weight:500;">Tienda</span>
    @if(request('search'))
        <span>›</span>
        <span style="color:#1a1212;">"{{ request('search') }}"</span>
    @endif
</div>

{{-- ══ LAYOUT ══ --}}
<div class="zt-shop-layout">

    {{-- ── SIDEBAR ── --}}
    <aside class="zt-sidebar">
        <p class="zt-sidebar-title">Filtros</p>

        <form method="GET" action="{{ route('tienda') }}" id="filterForm">

            {{-- Búsqueda --}}
            <div class="zt-filter-group">
                <p class="zt-filter-label">Buscar</p>
                <div class="zt-sidebar-search">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        placeholder="Nombre del producto..."
                        value="{{ request('search') }}"
                    >
                </div>
            </div>

            <hr class="zt-sidebar-divider" style="margin-top:0;">

            {{-- Ordenar --}}
            <div class="zt-filter-group">
                <p class="zt-filter-label">Ordenar por precio</p>
                <select class="zt-sidebar-select" name="sort">
                    <option value=""          {{ !request('sort')              ? 'selected' : '' }}>Por defecto</option>
                    <option value="priceAsc"  {{ request('sort') === 'priceAsc'  ? 'selected' : '' }}>Menor a mayor</option>
                    <option value="priceDesc" {{ request('sort') === 'priceDesc' ? 'selected' : '' }}>Mayor a menor</option>
                </select>
            </div>

            <button type="submit" class="zt-sidebar-btn">Aplicar filtros</button>

            @if(request('search') || request('sort'))
                <a href="{{ route('tienda') }}" class="zt-sidebar-clear">✕ Limpiar filtros</a>
            @endif

        </form>

        <hr class="zt-sidebar-divider">

        <div class="zt-sidebar-info">
            <p style="margin-bottom:10px;">
                <strong>Envío gratis</strong> en pedidos mayores a $150.
            </p>
            <p style="margin-bottom:10px;">
                <strong>Devoluciones</strong> dentro de los 30 días.
            </p>
            <p>
                <strong>Pago seguro</strong> con múltiples métodos disponibles.
            </p>
        </div>
    </aside>

    {{-- ── PRODUCTOS ── --}}
    <main class="zt-shop-main">

        {{-- Topbar --}}
        <div class="zt-shop-topbar">
            <p class="zt-shop-count">
                <strong>{{ $productos->total() }}</strong>
                {{ $productos->total() === 1 ? 'producto' : 'productos' }} encontrados
            </p>

            <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                @if(request('search'))
                    <span class="zt-filter-pill">
                        "{{ request('search') }}"
                        <a href="{{ route('tienda', array_merge(request()->except('search'), [])) }}">×</a>
                    </span>
                @endif
                @if(request('sort'))
                    <span class="zt-filter-pill">
                        {{ request('sort') === 'priceAsc' ? 'Precio ↑' : 'Precio ↓' }}
                        <a href="{{ route('tienda', array_merge(request()->except('sort'), [])) }}">×</a>
                    </span>
                @endif
            </div>
        </div>

        {{-- Grid --}}
        <div class="zt-products-grid" id="productos">
            @forelse($productos as $i => $producto)
                <div class="zt-product-card">
                    <div class="zt-product-img">
                        @if($producto->imagen)
                            <img
                                src="{{ asset('uploads/productos/' . $producto->imagen) }}"
                                alt="{{ $producto->nombre }}"
                                loading="lazy"
                            >
                        @else
                            <span style="font-size:72px;">👟</span>
                        @endif
                        @if($i < 3)
                            <span class="zt-product-badge">Nuevo</span>
                        @endif
                    </div>
                    <div class="zt-product-info">
                        <p class="zt-product-name" title="{{ $producto->nombre }}">{{ $producto->nombre }}</p>
                        <div class="zt-product-footer">
                            <span class="zt-product-price">{{ moneda($producto->precio) }}</span>
                            <div class="zt-card-actions">
                                <a href="{{ route('web.show', $producto->id) }}" class="zt-ver-btn">Ver</a>
                                <form action="{{ route('carrito.agregar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id"     value="{{ $producto->id }}">
                                    <input type="hidden" name="nombre" value="{{ $producto->nombre }}">
                                    <input type="hidden" name="precio" value="{{ $producto->precio }}">
                                    <input type="hidden" name="imagen" value="{{ $producto->imagen }}">
                                    <button type="submit" class="zt-add-btn" title="Agregar al carrito">+</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="zt-empty">
                    <div class="zt-empty-icon">👟</div>
                    <h3>Sin resultados</h3>
                    <p>No encontramos productos con ese criterio de búsqueda.</p>
                    <a href="{{ route('tienda') }}" class="zt-ver-btn" style="font-size:13px; padding:10px 24px;">
                        Ver todos los productos
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Paginación --}}
        <div class="zt-pagination">
            {{ $productos->appends(['search' => request('search'), 'sort' => request('sort')])->links() }}
        </div>

    </main>
</div>

@endsection