@extends('web.app')
@section('titulo', 'ZT|SHOES — Inicio')

@push('estilos')
<style>
    /* ══════════════════════════════════════
       HERO
    ══════════════════════════════════════ */
    .zt-home {
        display: flex;
        flex-direction: column;
    }

    .zt-hero {
        position: relative;
        min-height: calc(100vh - 64px);
        background: linear-gradient(135deg, #f5dde0 0%, #e8b4b8 45%, #d4878f 100%);
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .zt-hero-bg-text {
        position: absolute;
        font-family: 'Cormorant Garamond', serif;
        font-size: 320px; font-weight: 600;
        color: rgba(255,255,255,0.15);
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        white-space: nowrap;
        pointer-events: none; user-select: none;
        letter-spacing: -0.02em;
    }

    /* ── Columna izquierda ── */
    .zt-hero-inner {
        position: relative; z-index: 2;
        width: 100%;
        display: grid;
        grid-template-columns: 1.4fr 0.6fr;
        align-items: center;
        padding: 60px 64px;
        gap: 48px;
    }

    .zt-hero-content { animation: ztFadeUp 0.7s ease both; }

    @keyframes ztFadeUp {
        from { opacity: 0; transform: translateY(22px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .zt-hero-eyebrow {
        font-size: 11px; font-weight: 500;
        letter-spacing: 0.2em; text-transform: uppercase;
        color: #c47a82; margin-bottom: 16px;
    }

    .zt-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 64px; font-weight: 300;
        line-height: 1.03; color: #1a1212; margin-bottom: 20px;
    }

    .zt-hero-title em { font-style: italic; color: #c47a82; }

    .zt-hero-sub {
        font-size: 14px; color: #7a6060;
        line-height: 1.75; margin-bottom: 36px; max-width: 360px;
    }

    .zt-hero-actions { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }

    .zt-btn-dark {
        padding: 14px 32px; background: #1a1212; color: #fff;
        border: none; border-radius: 30px; font-size: 13px; font-weight: 500;
        font-family: 'DM Sans', sans-serif; text-decoration: none;
        letter-spacing: 0.05em; transition: opacity 0.2s; display: inline-block;
    }
    .zt-btn-dark:hover { opacity: 0.82; color: #fff; }

    .zt-btn-ghost {
        padding: 14px 32px; background: transparent; color: #1a1212;
        border: 1.5px solid rgba(26,18,18,0.28); border-radius: 30px;
        font-size: 13px; font-weight: 400; font-family: 'DM Sans', sans-serif;
        text-decoration: none; letter-spacing: 0.05em; transition: all 0.2s; display: inline-block;
    }
    .zt-btn-ghost:hover { background: rgba(26,18,18,0.06); border-color: rgba(26,18,18,0.45); color: #1a1212; }

    /* ── Columna derecha: slider ── */
    .zt-slider-wrap {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        aspect-ratio: 3/4;
        max-height: 460px;
        box-shadow: 0 24px 64px rgba(100,40,50,0.22);
        animation: ztFadeUp 0.9s 0.15s ease both;
        background: #f0dde0;
    }

    .zt-slider {
        display: flex;
        height: 100%;
        transition: transform 0.65s cubic-bezier(0.77, 0, 0.18, 1);
    }

    .zt-slide {
        min-width: 100%; height: 100%;
        position: relative; overflow: hidden;
    }

    .zt-slide img {
        width: 100%; height: 100%;
        object-fit: cover; object-position: center top;
        transition: transform 6s ease;
    }

    .zt-slide.active img { transform: scale(1.06); }

    /* Dots */
    .zt-slider-dots {
        position: absolute; bottom: 16px; left: 50%;
        transform: translateX(-50%);
        display: flex; gap: 6px; z-index: 10;
    }

    .zt-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: rgba(255,255,255,0.45); border: none;
        cursor: pointer; padding: 0; transition: all 0.3s;
    }
    .zt-dot.active { background: #fff; width: 20px; border-radius: 4px; }

    /* Flechas */
    .zt-slider-btn {
        position: absolute; top: 50%; transform: translateY(-50%);
        width: 36px; height: 36px; border-radius: 50%;
        background: rgba(255,255,255,0.85); border: none;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; z-index: 10; font-size: 14px;
        color: #1a1212; transition: background 0.2s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    }
    .zt-slider-btn:hover { background: #fff; }
    .zt-slider-btn.prev { left: 12px; }
    .zt-slider-btn.next { right: 12px; }

    /* Etiqueta flotante */
    .zt-slider-badge {
        position: absolute; top: 20px; left: 20px; z-index: 10;
        background: rgba(255,255,255,0.92); border-radius: 30px;
        padding: 6px 14px; font-size: 11px; font-weight: 500;
        color: #1a1212; letter-spacing: 0.08em; text-transform: uppercase;
        backdrop-filter: blur(6px);
    }

    /* ══════════════════════════════════════
       SOBRE NOSOTROS
    ══════════════════════════════════════ */
    .zt-about {
        padding: 96px 64px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 64px;
        align-items: center;
        background: #fff;
        border-top: 0.5px solid #f0e0e2;
    }

    .zt-about-img {
        border-radius: 20px; overflow: hidden;
        aspect-ratio: 4/3;
        background: linear-gradient(135deg, #f5dde0, #e8b4b8);
    }
    .zt-about-img img { width: 100%; height: 100%; object-fit: cover; }

    .zt-about-text {}
    .zt-about-eyebrow {
        font-size: 11px; font-weight: 500; letter-spacing: 0.2em;
        text-transform: uppercase; color: #c47a82; margin-bottom: 14px;
    }
    .zt-about-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 44px; font-weight: 300; line-height: 1.1;
        color: #1a1212; margin-bottom: 20px;
    }
    .zt-about-title em { font-style: italic; color: #c47a82; }
    .zt-about-body {
        font-size: 14px; color: #7a6060; line-height: 1.8;
        margin-bottom: 32px;
    }

    .zt-about-stats {
        display: flex; gap: 32px; margin-bottom: 36px;
    }
    .zt-stat-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 36px; font-weight: 600; color: #1a1212; line-height: 1;
    }
    .zt-stat-label { font-size: 12px; color: #7a6060; margin-top: 4px; }

    /* ══════════════════════════════════════
       PRODUCTOS DESTACADOS
    ══════════════════════════════════════ */
    .zt-featured {
        padding: 80px 64px;
        background: #fdf8f8;
        border-top: 0.5px solid #f0e0e2;
    }

    .zt-featured-header {
        display: flex; align-items: flex-end;
        justify-content: space-between; margin-bottom: 36px;
    }

    .zt-featured-eyebrow {
        font-size: 11px; font-weight: 500; letter-spacing: 0.2em;
        text-transform: uppercase; color: #c47a82; margin-bottom: 8px;
    }

    .zt-featured-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 38px; font-weight: 300; color: #1a1212;
    }

    .zt-featured-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .zt-product-card {
        background: #fff; border-radius: 16px; overflow: hidden;
        border: 0.5px solid #f0e0e2; cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none; color: inherit; display: block;
    }
    .zt-product-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(196,122,130,0.15); color: inherit; }

    .zt-product-img {
        height: 200px; overflow: hidden;
        background: linear-gradient(135deg, #f5dde0, #e8b4b8);
        display: flex; align-items: center; justify-content: center;
    }
    .zt-product-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .zt-product-card:hover .zt-product-img img { transform: scale(1.05); }

    .zt-product-info { padding: 14px 16px; }
    .zt-product-name { font-size: 13px; font-weight: 500; color: #1a1212; margin-bottom: 4px; }

    .zt-product-footer {
        display: flex; align-items: center;
        justify-content: space-between; margin-top: 10px;
    }
    .zt-product-price {
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px; font-weight: 600; color: #1a1212;
    }
    .zt-ver-btn {
        padding: 7px 16px; background: transparent; color: #1a1212;
        border: 1.5px solid rgba(26,18,18,0.2); border-radius: 20px;
        font-size: 12px; font-weight: 500; cursor: pointer;
        font-family: 'DM Sans', sans-serif; transition: all 0.15s;
        text-decoration: none; display: inline-block;
    }
    .zt-ver-btn:hover { background: #1a1212; color: #fff; border-color: #1a1212; }

    .zt-add-btn {
        width: 32px; height: 32px; background: #1a1212; color: #fff;
        border: none; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 20px; line-height: 1; transition: background 0.2s;
    }
    .zt-add-btn:hover { background: #c47a82; }

    .zt-featured-cta {
        text-align: center; margin-top: 48px;
    }

    /* ══════════════════════════════════════
       RESPONSIVE
    ══════════════════════════════════════ */
    @media (max-width: 1024px) {
        .zt-featured-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .zt-hero-inner { grid-template-columns: 1fr; padding: 40px 24px; gap: 32px; }
        .zt-hero-title { font-size: 44px; }
        .zt-hero-bg-text { font-size: 160px; }
        .zt-slider-wrap { aspect-ratio: 3/4; }
        .zt-about { grid-template-columns: 1fr; padding: 56px 24px; gap: 36px; }
        .zt-about-title { font-size: 34px; }
        .zt-featured { padding: 56px 24px; }
        .zt-featured-grid { grid-template-columns: repeat(2, 1fr); }
        .zt-featured-header { flex-direction: column; align-items: flex-start; gap: 12px; }
    }

    @media (max-width: 480px) {
        .zt-featured-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('contenido')
<div class="zt-home">

    {{-- ══ HERO ══ --}}
    <section class="zt-hero">
        <div class="zt-hero-bg-text">ZT</div>

        <div class="zt-hero-inner">

            {{-- Texto izquierdo --}}
            <div class="zt-hero-content">
                <p class="zt-hero-eyebrow">Colección 2025</p>
                <h1 class="zt-hero-title">
                    Camina con<br><em>estilo</em> propio
                </h1>
                <p class="zt-hero-sub">
                    Calzado diseñado para quienes no siguen tendencias — las crean.
                    Cada par cuenta una historia única.
                </p>
                <div class="zt-hero-actions">
                    <a href="{{ route('tienda') }}" class="zt-btn-dark">Ir a la tienda</a>
                    <a href="#sobre-nosotros" class="zt-btn-ghost">Conoce la marca</a>
                </div>
            </div>

            {{-- Slider derecho --}}
            <div class="zt-slider-wrap">
                <span class="zt-slider-badge">Nueva colección</span>

                <div class="zt-slider" id="ztSlider">
                    @php
                        $slides = [
                            'assets/img/gallery/img1.png',
                            'assets/img/gallery/mg2.png',
                            'assets/img/gallery/img3.png',
                            'assets/img/gallery/img4.png',
                            'assets/img/gallery/img5.png',
                        ];
                    @endphp

                    @foreach($slides as $i => $src)
                        <div class="zt-slide {{ $i === 0 ? 'active' : '' }}">
                            <img src="{{ asset($src) }}" alt="ZT Shoes colección {{ $i + 1 }}" loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
                        </div>
                    @endforeach
                </div>

                <button class="zt-slider-btn prev" id="ztPrev" aria-label="Anterior">&#8592;</button>
                <button class="zt-slider-btn next" id="ztNext" aria-label="Siguiente">&#8594;</button>

                <div class="zt-slider-dots" id="ztDots">
                    @foreach($slides as $i => $src)
                        <button class="zt-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}" aria-label="Imagen {{ $i + 1 }}"></button>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    {{-- ══ SOBRE NOSOTROS ══ --}}
    <section class="zt-about" id="sobre-nosotros">
        <div class="zt-about-img">
            <img src="{{ asset('assets/img/fondos/header-bg.png') }}" alt="ZT Shoes estudio">
        </div>
        <div class="zt-about-text">
            <p class="zt-about-eyebrow">Nuestra historia</p>
            <h2 class="zt-about-title">
                Hechos para <em>durar</em>,<br>diseñados para brillar
            </h2>
            <p class="zt-about-body">
                En ZT|SHOES creemos que el calzado es más que una prenda — es una declaración.
                Cada par nace de materiales cuidadosamente seleccionados y un proceso artesanal
                que garantiza comodidad sin sacrificar el estilo.
            </p>
            <p class="zt-about-body" style="margin-top: -16px;">
                Desde 2020 hemos vestido los pasos de miles de personas que eligen caminar
                diferente, con confianza y con propósito.
            </p>
            <div class="zt-about-stats">
                <div>
                    <div class="zt-stat-num">+5K</div>
                    <div class="zt-stat-label">Clientes felices</div>
                </div>
                <div>
                    <div class="zt-stat-num">80+</div>
                    <div class="zt-stat-label">Modelos únicos</div>
                </div>
                <div>
                    <div class="zt-stat-num">5★</div>
                    <div class="zt-stat-label">Valoración media</div>
                </div>
            </div>
            <a href="{{ route('tienda') }}" class="zt-btn-dark">Explorar colección</a>
        </div>
    </section>

    {{-- ══ PRODUCTOS DESTACADOS ══ --}}
    <section class="zt-featured">
        <div class="zt-featured-header">
            <div>
                <p class="zt-featured-eyebrow">Lo más nuevo</p>
                <h2 class="zt-featured-title">Productos destacados</h2>
            </div>
            <a href="{{ route('tienda') }}" class="zt-btn-ghost" style="white-space:nowrap;">Ver todos →</a>
        </div>

        <div class="zt-featured-grid">
            @forelse($destacados as $producto)
                <div class="zt-product-card">
                    <div class="zt-product-img">
                        @if($producto->imagen)
                            <img src="{{ asset('uploads/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                        @else
                            <span style="font-size:64px;">👟</span>
                        @endif
                    </div>
                    <div class="zt-product-info">
                        <p class="zt-product-name">{{ $producto->nombre }}</p>
                        <div class="zt-product-footer">
                            <span class="zt-product-price">{{ moneda($producto->precio) }}</span>
                            <div style="display:flex;gap:6px;align-items:center;">
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
                <p style="color:#7a6060;font-size:14px;grid-column:1/-1;">
                    No hay productos disponibles aún.
                </p>
            @endforelse
        </div>

        <div class="zt-featured-cta">
            <a href="{{ route('tienda') }}" class="zt-btn-dark">Ver toda la tienda</a>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
(function () {
    const slider  = document.getElementById('ztSlider');
    const slides  = slider.querySelectorAll('.zt-slide');
    const dots    = document.querySelectorAll('.zt-dot');
    const btnPrev = document.getElementById('ztPrev');
    const btnNext = document.getElementById('ztNext');
    let current = 0;
    let timer;

    function goTo(index) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (index + slides.length) % slides.length;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
        slider.style.transform = `translateX(-${current * 100}%)`;
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function startAuto() {
        timer = setInterval(next, 4000);
    }

    function resetAuto() {
        clearInterval(timer);
        startAuto();
    }

    btnNext.addEventListener('click', () => { next(); resetAuto(); });
    btnPrev.addEventListener('click', () => { prev(); resetAuto(); });
    dots.forEach(dot => dot.addEventListener('click', () => {
        goTo(parseInt(dot.dataset.index));
        resetAuto();
    }));

    // Swipe táctil
    let startX = 0;
    slider.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
    slider.addEventListener('touchend', e => {
        const diff = startX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) { diff > 0 ? next() : prev(); resetAuto(); }
    });

    startAuto();
})();
</script>
@endpush