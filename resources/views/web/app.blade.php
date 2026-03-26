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
        .zt-nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px; height: 64px;
            background: rgba(255,255,255,0.97);
            border-bottom: 0.5px solid #f0e0e2;
            position: sticky; top: 0; z-index: 100;
            backdrop-filter: blur(8px);
        }
        .zt-nav-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px; font-weight: 600; letter-spacing: 0.08em;
            color: var(--ink); text-decoration: none;
            flex-shrink: 0;
        }
        .zt-nav-logo span { color: var(--rose-dark); }

        /* Links desktop */
        .zt-nav-links { display: flex; gap: 28px; align-items: center; list-style: none; }
        .zt-nav-links a {
            font-size: 13px; font-weight: 400; color: var(--muted);
            text-decoration: none; letter-spacing: 0.03em; transition: color 0.2s;
        }
        .zt-nav-links a:hover, .zt-nav-links a.active { color: var(--ink); }
        .zt-nav-links a.active { font-weight: 500; }

        /* Dropdown desktop */
        .zt-dropdown { position: relative; }
        .zt-dropdown-toggle { cursor: pointer; user-select: none; }
        .zt-dropdown-menu {
            display: none; position: absolute; top: calc(100% + 6px); right: 0;
            background: var(--white); border: 0.5px solid #f0e0e2;
            border-radius: 12px; min-width: 180px; overflow: hidden;
            box-shadow: 0 8px 24px rgba(196,122,130,0.12); z-index: 300;
        }
        .zt-dropdown-menu.open { display: block; }
        .zt-dropdown-menu a {
            display: flex; align-items: center; gap: 8px;
            padding: 11px 16px; font-size: 13px;
            box-shadow: 0 8px 24px rgba(196,122,130,0.12); z-index: 200;
        }
        .zt-dropdown-menu.open { display: block; }
        .zt-dropdown-menu a {
            display: block; padding: 11px 16px; font-size: 13px;
            color: var(--muted); text-decoration: none; transition: background 0.15s, color 0.15s;
        }
        .zt-dropdown-menu a:hover { background: var(--nude); color: var(--ink); }
        .zt-dropdown-menu hr { border: none; border-top: 0.5px solid #f0e0e2; margin: 4px 0; }

        /* Cart button */
        .zt-cart-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 20px; background: var(--ink); color: var(--white);
            border: none; border-radius: 30px; font-size: 13px; font-weight: 500;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            text-decoration: none; transition: opacity 0.2s; flex-shrink: 0;
        }
        .zt-cart-btn:hover { opacity: 0.85; color: var(--white); }
        .zt-cart-count {
            background: var(--rose); color: var(--ink);
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
            width: 18px; height: 18px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 500;
        }

        /* ── HAMBURGER BUTTON ── */
        .zt-nav-hamburger {
            display: none;
            flex-direction: column; justify-content: center; align-items: center;
            width: 40px; height: 40px;
            background: none; border: none; cursor: pointer; gap: 5px;
            padding: 6px;
        }
        .zt-nav-hamburger span {
            display: block; width: 22px; height: 1.5px;
            background: var(--ink); border-radius: 2px;
            transition: all 0.3s ease;
            transform-origin: center;
        }
        .zt-nav-hamburger.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
        .zt-nav-hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .zt-nav-hamburger.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

        /* ── MOBILE MENU DRAWER ── */
        .zt-mobile-menu {
            display: none;
            position: fixed; top: 64px; left: 0; right: 0; bottom: 0;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(12px);
            z-index: 99;
            flex-direction: column;
            padding: 32px 28px 40px;
            gap: 0;
            overflow-y: auto;
            transform: translateY(-8px);
            opacity: 0;
            transition: opacity 0.25s ease, transform 0.25s ease;
        }
        .zt-mobile-menu.open {
            display: flex;
            opacity: 1;
            transform: translateY(0);
        }
        .zt-mobile-menu a {
            font-size: 16px; font-weight: 400; color: var(--muted);
            text-decoration: none; padding: 14px 0;
            border-bottom: 0.5px solid #f5eded;
            transition: color 0.2s;
            letter-spacing: 0.02em;
        }
        .zt-mobile-menu a:hover, .zt-mobile-menu a.active { color: var(--ink); }
        .zt-mobile-menu a.active { font-weight: 500; }
        .zt-mobile-menu .zt-mobile-section-label {
            font-size: 10px; letter-spacing: 0.18em; text-transform: uppercase;
            color: var(--rose-dark); font-weight: 500;
            margin-top: 24px; margin-bottom: 4px;
            padding-bottom: 0; border-bottom: none;
        }
        .zt-mobile-menu a.text-danger-soft { color: #c47a82; }
        .zt-mobile-cart {
            margin-top: 28px;
            display: flex; align-items: center; gap: 10px;
            padding: 14px 24px; background: var(--ink); color: var(--white);
            border-radius: 30px; font-size: 14px; font-weight: 500;
            text-decoration: none; justify-content: center;
        }

        /* ── FOOTER ── */
        .zt-footer {
            background: var(--ink); color: rgba(255,255,255,0.45);
            padding: 22px 40px; display: flex;
            justify-content: space-between; align-items: center;
            font-size: 12px; margin-top: 40px;
        }
        .zt-footer a { color: var(--rose); text-decoration: none; }
        .zt-footer a:hover { color: var(--rose-light); }

        /* ══════════════════════
           RESPONSIVE NAVBAR
        ══════════════════════ */
        @media (max-width: 768px) {
            .zt-nav { padding: 0 20px; }
            .zt-nav-links { display: none; }
            .zt-cart-btn { display: none; }
            .zt-nav-hamburger { display: flex; }
            .zt-footer { padding: 18px 20px; flex-direction: column; gap: 6px; text-align: center; }
        }
    </style>
    @stack('estilos')
</head>
<body>

{{-- ══ NAVBAR ══ --}}
<nav class="zt-nav">
    <a href="{{ route('web.home') }}" class="zt-nav-logo">ZT <span>|</span> SHOES</a>

    {{-- Links escritorio --}}
{{-- NAVBAR --}}
<nav class="zt-nav">
    <a href="{{ route('web.home') }}" class="zt-nav-logo">ZT <span>|</span> SHOES</a>

    {{-- Links desktop --}}
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
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            </li>
        @endguest
    </ul>

    {{-- Cart desktop --}}
{{-- CONTENIDO --}}
@yield('contenido')

{{-- FOOTER --}}
<footer class="zt-footer">
    <span>Copyright &copy; {{ date('Y') }} <a href="{{ route('web.home') }}">ZT_SHOES</a>. All rights reserved.</span>
    <span>Anything you want</span>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Dropdown desktop
        var menu = this.closest('.zt-dropdown').querySelector('.zt-dropdown-menu');
        document.querySelectorAll('.zt-dropdown-menu.open').forEach(function(m) {
            if (m !== menu) m.classList.remove('open');
        });
        menu.classList.toggle('open');
    });
});
document.addEventListener('click', function() {
    document.querySelectorAll('.zt-dropdown-menu.open').forEach(function(m) {
        m.classList.remove('open');
    });
});

// Hamburger mobile
var hamburger = document.getElementById('ztHamburger');
var mobileMenu = document.getElementById('ztMobileMenu');
var cartMobile = document.getElementById('zt-cart-mobile');

// Ocultar carrito mobile en desktop, mostrar hamburger solo en mobile
function handleResize() {
    if (window.innerWidth > 768) {
        if (cartMobile) cartMobile.style.display = 'none';
        hamburger.style.display = 'none';
        mobileMenu.classList.remove('open');
        hamburger.classList.remove('open');
        document.body.style.overflow = '';
    } else {
        if (cartMobile) cartMobile.style.display = 'flex';
        hamburger.style.display = 'flex';
    }
}
handleResize();
window.addEventListener('resize', handleResize);

hamburger.addEventListener('click', function() {
    hamburger.classList.toggle('open');
    mobileMenu.classList.toggle('open');
    document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
});

// Cerrar al hacer click en un link del menú móvil
mobileMenu.querySelectorAll('a:not(.zt-mobile-cart)').forEach(function(link) {
    link.addEventListener('click', function() {
        hamburger.classList.remove('open');
        mobileMenu.classList.remove('open');
        document.body.style.overflow = '';
    });
});
</script>
@stack('scripts')
</body>
</html>