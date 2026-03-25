<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Shop | ZT_SHOES.com" />
    <meta name="author" content="ZT_SHOES" />
    <meta name="description" content="Shop | ZT_SHOES.com" />
    <title>@yield('titulo', 'Shop - ZT|SHOES')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
<<<<<<< HEAD
            --rose:       #e8b4b8;
            --rose-light: #f5dde0;
            --rose-dark:  #c47a82;
            --nude:       #f0e6e0;
            --ink:        #1a1212;
            --muted:      #7a6060;
            --white:      #fff;
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--white); color: var(--ink); }

        /* ══════════════════════════════════════
           NAVBAR — Desktop
        ══════════════════════════════════════ */
=======
            --rose: #e8b4b8;
            --rose-light: #f5dde0;
            --rose-dark: #c47a82;
            --nude: #f0e6e0;
            --ink: #1a1212;
            --muted: #7a6060;
            --white: #fff;
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--white); color: var(--ink); }

        /* ── NAVBAR ── */
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
        .zt-nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px; height: 64px;
            background: rgba(255,255,255,0.97);
            border-bottom: 0.5px solid #f0e0e2;
<<<<<<< HEAD
            position: sticky; top: 0; z-index: 200;
=======
            position: sticky; top: 0; z-index: 100;
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
            backdrop-filter: blur(8px);
        }
        .zt-nav-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px; font-weight: 600; letter-spacing: 0.08em;
<<<<<<< HEAD
            color: var(--ink); text-decoration: none; flex-shrink: 0;
        }
        .zt-nav-logo span { color: var(--rose-dark); }

        /* Links escritorio */
        .zt-nav-links {
            display: flex; gap: 28px; align-items: center; list-style: none;
        }
=======
            color: var(--ink); text-decoration: none;
        }
        .zt-nav-logo span { color: var(--rose-dark); }
        .zt-nav-links { display: flex; gap: 28px; align-items: center; list-style: none; }
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
        .zt-nav-links a {
            font-size: 13px; font-weight: 400; color: var(--muted);
            text-decoration: none; letter-spacing: 0.03em; transition: color 0.2s;
        }
        .zt-nav-links a:hover, .zt-nav-links a.active { color: var(--ink); }
        .zt-nav-links a.active { font-weight: 500; }
<<<<<<< HEAD

        /* Dropdown escritorio */
=======
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
        .zt-dropdown { position: relative; }
        .zt-dropdown-toggle { cursor: pointer; user-select: none; }
        .zt-dropdown-menu {
            display: none; position: absolute; top: calc(100% + 6px); right: 0;
            background: var(--white); border: 0.5px solid #f0e0e2;
            border-radius: 12px; min-width: 180px; overflow: hidden;
<<<<<<< HEAD
            box-shadow: 0 8px 24px rgba(196,122,130,0.12); z-index: 300;
        }
        .zt-dropdown-menu.open { display: block; }
        .zt-dropdown-menu a {
            display: flex; align-items: center; gap: 8px;
            padding: 11px 16px; font-size: 13px;
=======
            box-shadow: 0 8px 24px rgba(196,122,130,0.12); z-index: 200;
        }
        .zt-dropdown-menu.open { display: block; }
        .zt-dropdown-menu a {
            display: block; padding: 11px 16px; font-size: 13px;
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
            color: var(--muted); text-decoration: none; transition: background 0.15s, color 0.15s;
        }
        .zt-dropdown-menu a:hover { background: var(--nude); color: var(--ink); }
        .zt-dropdown-menu hr { border: none; border-top: 0.5px solid #f0e0e2; margin: 4px 0; }
<<<<<<< HEAD

        /* Botón carrito */
=======
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
        .zt-cart-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 20px; background: var(--ink); color: var(--white);
            border: none; border-radius: 30px; font-size: 13px; font-weight: 500;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
<<<<<<< HEAD
            text-decoration: none; transition: opacity 0.2s; flex-shrink: 0;
=======
            text-decoration: none; transition: opacity 0.2s;
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
        }
        .zt-cart-btn:hover { opacity: 0.85; color: var(--white); }
        .zt-cart-count {
            background: var(--rose); color: var(--ink);
<<<<<<< HEAD
            min-width: 18px; height: 18px; border-radius: 9px; padding: 0 4px;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 600;
        }

        /* ══════════════════════════════════════
           HAMBURGER BUTTON
        ══════════════════════════════════════ */
        .zt-hamburger {
            display: none;
            flex-direction: column; justify-content: center; align-items: center;
            gap: 5px; width: 40px; height: 40px;
            background: none; border: none; cursor: pointer; padding: 4px;
            border-radius: 8px; transition: background 0.2s;
        }
        .zt-hamburger:hover { background: var(--rose-light); }
        .zt-hamburger span {
            display: block; width: 22px; height: 1.5px;
            background: var(--ink); border-radius: 2px;
            transition: transform 0.3s, opacity 0.3s, width 0.3s;
            transform-origin: center;
        }
        .zt-hamburger.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
        .zt-hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .zt-hamburger.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

        /* ══════════════════════════════════════
           MOBILE DRAWER
        ══════════════════════════════════════ */
        .zt-mobile-menu {
            display: none;
            position: fixed; inset: 0; z-index: 150;
        }
        .zt-mobile-menu.open { display: block; }

        /* Overlay difuminado */
        .zt-mobile-overlay {
            position: absolute; inset: 0;
            background: rgba(26,18,18,0.4);
            backdrop-filter: blur(2px);
            animation: fadeIn 0.2s ease;
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        /* Panel deslizante */
        .zt-mobile-drawer {
            position: absolute; top: 0; right: 0; bottom: 0;
            width: min(320px, 85vw);
            background: #fff;
            display: flex; flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: -8px 0 32px rgba(26,18,18,0.15);
        }
        .zt-mobile-menu.open .zt-mobile-drawer {
            transform: translateX(0);
        }

        /* Header del drawer */
        .zt-drawer-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 0.5px solid #f0e0e2;
            background: #fdf8f8;
        }
        .zt-drawer-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; font-weight: 600; letter-spacing: 0.08em;
            color: var(--ink); text-decoration: none;
        }
        .zt-drawer-logo span { color: var(--rose-dark); }
        .zt-drawer-close {
            width: 32px; height: 32px; border-radius: 8px;
            background: var(--rose-light); border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--rose-dark); font-size: 16px; transition: background 0.15s;
        }
        .zt-drawer-close:hover { background: var(--rose); color: #fff; }

        /* User info en drawer */
        .zt-drawer-user {
            padding: 16px 24px;
            border-bottom: 0.5px solid #f0e0e2;
            background: #fdf8f8;
        }
        .zt-drawer-user-name {
            font-size: 14px; font-weight: 600; color: var(--ink);
        }
        .zt-drawer-user-email {
            font-size: 12px; color: var(--muted); margin-top: 2px;
        }

        /* Links del drawer */
        .zt-drawer-links {
            flex: 1; overflow-y: auto;
            padding: 12px 0;
        }
        .zt-drawer-link {
            display: flex; align-items: center; gap: 12px;
            padding: 13px 24px; font-size: 14px; color: var(--muted);
            text-decoration: none; transition: background 0.15s, color 0.15s;
            border-left: 2px solid transparent;
        }
        .zt-drawer-link:hover {
            background: var(--rose-light); color: var(--ink);
            border-left-color: var(--rose-dark);
        }
        .zt-drawer-link.active {
            color: var(--rose-dark); font-weight: 500;
            border-left-color: var(--rose-dark);
            background: var(--rose-light);
        }
        .zt-drawer-link i { font-size: 16px; width: 20px; text-align: center; flex-shrink: 0; }
        .zt-drawer-sep {
            height: 0.5px; background: #f0e0e2; margin: 8px 24px;
        }
        .zt-drawer-section {
            font-size: 10px; font-weight: 600; letter-spacing: 0.15em;
            text-transform: uppercase; color: #ccc;
            padding: 12px 24px 4px;
        }

        /* Carrito en footer del drawer */
        .zt-drawer-footer {
            padding: 16px 24px;
            border-top: 0.5px solid #f0e0e2;
        }
        .zt-drawer-cart {
            display: flex; align-items: center; justify-content: space-between;
            padding: 13px 18px;
            background: var(--ink); color: #fff; border-radius: 12px;
            text-decoration: none; font-size: 13px; font-weight: 500;
            transition: opacity 0.2s;
        }
        .zt-drawer-cart:hover { opacity: 0.85; color: #fff; }
        .zt-drawer-cart-left { display: flex; align-items: center; gap: 10px; }
        .zt-drawer-cart-badge {
            background: var(--rose); color: var(--ink);
            font-size: 11px; font-weight: 600;
            padding: 2px 8px; border-radius: 10px;
        }

        /* ══════════════════════════════════════
           FOOTER
        ══════════════════════════════════════ */
=======
            width: 18px; height: 18px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 500;
        }

        /* ── FOOTER ── */
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
        .zt-footer {
            background: var(--ink); color: rgba(255,255,255,0.45);
            padding: 22px 40px; display: flex;
            justify-content: space-between; align-items: center;
<<<<<<< HEAD
            font-size: 12px; margin-top: 40px; flex-wrap: wrap; gap: 8px;
=======
            font-size: 12px; margin-top: 40px;
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
        }
        .zt-footer a { color: var(--rose); text-decoration: none; }
        .zt-footer a:hover { color: var(--rose-light); }

<<<<<<< HEAD
        /* ══════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════ */
        @media (max-width: 768px) {
            .zt-nav { padding: 0 16px; height: 56px; }
            .zt-nav-links { display: none; }   /* Ocultar links en móvil */
            .zt-cart-btn { display: none; }    /* Ocultar carrito en móvil (está en drawer) */
            .zt-hamburger { display: flex; }   /* Mostrar hamburguesa */
            .zt-footer { padding: 20px 16px; flex-direction: column; text-align: center; gap: 6px; }
        }
        @media (min-width: 769px) {
            .zt-mobile-menu { display: none !important; } /* Nunca mostrar drawer en escritorio */
=======
        @media (max-width: 768px) {
            .zt-nav { padding: 0 20px; }
            .zt-nav-links { gap: 16px; }
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
        }
    </style>
    @stack('estilos')
</head>
<body>

<<<<<<< HEAD
{{-- ══ NAVBAR ══ --}}
<nav class="zt-nav">
    <a href="{{ route('web.home') }}" class="zt-nav-logo">ZT <span>|</span> SHOES</a>

    {{-- Links escritorio --}}
=======
{{-- NAVBAR --}}
<nav class="zt-nav">
    <a href="{{ route('web.home') }}" class="zt-nav-logo">ZT <span>|</span> SHOES</a>

>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
    <ul class="zt-nav-links">
        <li><a href="{{ route('web.home') }}" class="{{ request()->routeIs('web.home') ? 'active' : '' }}">Inicio</a></li>
        <li><a href="{{ route('tienda') }}" class="{{ request()->routeIs('tienda') ? 'active' : '' }}">Tienda</a></li>

        @guest
            <li><a href="{{ route('registro') }}">Registrarse</a></li>
            <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
        @else
            <li class="zt-dropdown">
                <a href="#" class="zt-dropdown-toggle">{{ auth()->user()->name }} ▾</a>
                <div class="zt-dropdown-menu">
<<<<<<< HEAD
                    <a href="{{ route('perfil.pedidos') }}"><i class="bi bi-bag"></i> Mis pedidos</a>
                    <a href="{{ route('perfil.edit') }}"><i class="bi bi-person"></i> Mi perfil</a>
                    @hasrole('admin')
                        <hr>
                        <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Panel admin</a>
                        <a href="{{ route('productos.index') }}"><i class="bi bi-archive"></i> Productos</a>
                        <a href="{{ route('usuarios.index') }}"><i class="bi bi-people"></i> Usuarios</a>
                    @endhasrole
                    <hr>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
=======
                    <a href="{{ route('perfil.pedidos') }}">Mis pedidos</a>
                    <a href="{{ route('perfil.edit') }}">Mi perfil</a>
                    @hasrole('admin')
                        <hr>
                        <a href="{{ route('dashboard') }}">Panel admin</a>
                        <a href="{{ route('productos.index') }}">Productos</a>
                        <a href="{{ route('usuarios.index') }}">Usuarios</a>
                    @endhasrole
                    <hr>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            </li>
        @endguest
    </ul>

<<<<<<< HEAD
    {{-- Carrito escritorio --}}
    @php
        $carritoKey = auth()->check() ? 'carrito_' . auth()->id() : 'carrito_guest';
        $carritoNav = session($carritoKey, []);
        $carritoCount = array_sum(array_column($carritoNav, 'cantidad'));
    @endphp
    <a href="{{ route('carrito.mostrar') }}" class="zt-cart-btn">
        <i class="bi-cart-fill"></i>
        Carrito
        <span class="zt-cart-count">{{ $carritoCount }}</span>
    </a>

    {{-- Hamburguesa móvil --}}
    <button class="zt-hamburger" id="zt-hamburger" aria-label="Menú">
        <span></span><span></span><span></span>
    </button>
</nav>

{{-- ══ MOBILE DRAWER ══ --}}
<div class="zt-mobile-menu" id="zt-mobile-menu">
    <div class="zt-mobile-overlay" id="zt-overlay"></div>
    <div class="zt-mobile-drawer">

        {{-- Header --}}
        <div class="zt-drawer-head">
            <a href="{{ route('web.home') }}" class="zt-drawer-logo">ZT <span>|</span> SHOES</a>
            <button class="zt-drawer-close" id="zt-drawer-close">✕</button>
        </div>

        {{-- Info usuario --}}
        @auth
        <div class="zt-drawer-user">
            <div class="zt-drawer-user-name">{{ auth()->user()->name }}</div>
            <div class="zt-drawer-user-email">{{ auth()->user()->email }}</div>
        </div>
        @endauth

        {{-- Links --}}
        <div class="zt-drawer-links">
            <span class="zt-drawer-section">Tienda</span>
            <a href="{{ route('web.home') }}" class="zt-drawer-link {{ request()->routeIs('web.home') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Inicio
            </a>
            <a href="{{ route('tienda') }}" class="zt-drawer-link {{ request()->routeIs('tienda') ? 'active' : '' }}">
                <i class="bi bi-shop"></i> Tienda
            </a>

            @guest
                <div class="zt-drawer-sep"></div>
                <span class="zt-drawer-section">Cuenta</span>
                <a href="{{ route('registro') }}" class="zt-drawer-link">
                    <i class="bi bi-person-plus"></i> Registrarse
                </a>
                <a href="{{ route('login') }}" class="zt-drawer-link">
                    <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                </a>
            @else
                <div class="zt-drawer-sep"></div>
                <span class="zt-drawer-section">Mi cuenta</span>
                <a href="{{ route('perfil.pedidos') }}" class="zt-drawer-link {{ request()->routeIs('perfil.pedidos') ? 'active' : '' }}">
                    <i class="bi bi-bag"></i> Mis pedidos
                </a>
                <a href="{{ route('perfil.edit') }}" class="zt-drawer-link {{ request()->routeIs('perfil.edit') ? 'active' : '' }}">
                    <i class="bi bi-person"></i> Mi perfil
                </a>
                @hasrole('admin')
                    <div class="zt-drawer-sep"></div>
                    <span class="zt-drawer-section">Administración</span>
                    <a href="{{ route('dashboard') }}" class="zt-drawer-link">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('productos.index') }}" class="zt-drawer-link">
                        <i class="bi bi-archive"></i> Productos
                    </a>
                    <a href="{{ route('usuarios.index') }}" class="zt-drawer-link">
                        <i class="bi bi-people"></i> Usuarios
                    </a>
                @endhasrole
                <div class="zt-drawer-sep"></div>
                <a href="#" class="zt-drawer-link"
                   onclick="event.preventDefault(); document.getElementById('logout-mobile').submit();"
                   style="color:#dc2626;">
                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                </a>
                <form id="logout-mobile" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            @endguest
        </div>

        {{-- Footer del drawer: carrito --}}
        <div class="zt-drawer-footer">
            <a href="{{ route('carrito.mostrar') }}" class="zt-drawer-cart">
                <div class="zt-drawer-cart-left">
                    <i class="bi bi-cart-fill"></i>
                    Mi carrito
                </div>
                <span class="zt-drawer-cart-badge">{{ $carritoCount }}</span>
            </a>
        </div>

    </div>
</div>

=======
    <a href="{{ route('carrito.mostrar') }}" class="zt-cart-btn">
        <i class="bi-cart-fill"></i>
        Pedido
        <span class="zt-cart-count">
            @php
                $carritoKey = auth()->check() ? 'carrito_' . auth()->id() : 'carrito_guest';
                $carritoNav = session($carritoKey, []);
            @endphp
            {{ array_sum(array_column($carritoNav, 'cantidad')) }}
        </span>
    </a>
</nav>

>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
{{-- CONTENIDO --}}
@yield('contenido')

{{-- FOOTER --}}
<footer class="zt-footer">
    <span>Copyright &copy; {{ date('Y') }} <a href="{{ route('web.home') }}">ZT_SHOES</a>. All rights reserved.</span>
<<<<<<< HEAD
    <span><a href="{{ route('tienda') }}">Tienda</a> · <a href="{{ route('carrito.mostrar') }}">Carrito</a></span>
=======
    <span>Anything you want</span>
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
<<<<<<< HEAD
// ── Dropdown escritorio ──
document.querySelectorAll('.zt-dropdown-toggle').forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
        e.preventDefault(); e.stopPropagation();
=======
document.querySelectorAll('.zt-dropdown-toggle').forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
        var menu = this.closest('.zt-dropdown').querySelector('.zt-dropdown-menu');
        document.querySelectorAll('.zt-dropdown-menu.open').forEach(function(m) {
            if (m !== menu) m.classList.remove('open');
        });
        menu.classList.toggle('open');
    });
});
document.addEventListener('click', function() {
<<<<<<< HEAD
    document.querySelectorAll('.zt-dropdown-menu.open').forEach(function(m) { m.classList.remove('open'); });
});

// ── Drawer móvil ──
var hamburger  = document.getElementById('zt-hamburger');
var mobileMenu = document.getElementById('zt-mobile-menu');
var overlay    = document.getElementById('zt-overlay');
var closeBtn   = document.getElementById('zt-drawer-close');

function openDrawer() {
    mobileMenu.classList.add('open');
    hamburger.classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeDrawer() {
    mobileMenu.classList.remove('open');
    hamburger.classList.remove('open');
    document.body.style.overflow = '';
}

hamburger.addEventListener('click', function() {
    mobileMenu.classList.contains('open') ? closeDrawer() : openDrawer();
});
overlay.addEventListener('click', closeDrawer);
closeBtn.addEventListener('click', closeDrawer);

// Cerrar con tecla Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDrawer();
=======
    document.querySelectorAll('.zt-dropdown-menu.open').forEach(function(m) {
        m.classList.remove('open');
    });
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
});
</script>
@stack('scripts')
</body>
</html>