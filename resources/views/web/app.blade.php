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
        }
        .zt-nav-logo span { color: var(--rose-dark); }
        .zt-nav-links { display: flex; gap: 28px; align-items: center; list-style: none; }
        .zt-nav-links a {
            font-size: 13px; font-weight: 400; color: var(--muted);
            text-decoration: none; letter-spacing: 0.03em; transition: color 0.2s;
        }
        .zt-nav-links a:hover, .zt-nav-links a.active { color: var(--ink); }
        .zt-nav-links a.active { font-weight: 500; }
        .zt-dropdown { position: relative; }
        .zt-dropdown-toggle { cursor: pointer; user-select: none; }
        .zt-dropdown-menu {
            display: none; position: absolute; top: calc(100% + 6px); right: 0;
            background: var(--white); border: 0.5px solid #f0e0e2;
            border-radius: 12px; min-width: 180px; overflow: hidden;
            box-shadow: 0 8px 24px rgba(196,122,130,0.12); z-index: 200;
        }
        .zt-dropdown-menu.open { display: block; }
        .zt-dropdown-menu a {
            display: block; padding: 11px 16px; font-size: 13px;
            color: var(--muted); text-decoration: none; transition: background 0.15s, color 0.15s;
        }
        .zt-dropdown-menu a:hover { background: var(--nude); color: var(--ink); }
        .zt-dropdown-menu hr { border: none; border-top: 0.5px solid #f0e0e2; margin: 4px 0; }
        .zt-cart-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 20px; background: var(--ink); color: var(--white);
            border: none; border-radius: 30px; font-size: 13px; font-weight: 500;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            text-decoration: none; transition: opacity 0.2s;
        }
        .zt-cart-btn:hover { opacity: 0.85; color: var(--white); }
        .zt-cart-count {
            background: var(--rose); color: var(--ink);
            width: 18px; height: 18px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 500;
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

        @media (max-width: 768px) {
            .zt-nav { padding: 0 20px; }
            .zt-nav-links { gap: 16px; }
        }
    </style>
    @stack('estilos')
</head>
<body>

{{-- NAVBAR --}}
<nav class="zt-nav">
    <a href="{{ route('web.home') }}" class="zt-nav-logo">ZT <span>|</span> SHOES</a>

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

{{-- CONTENIDO --}}
@yield('contenido')

{{-- FOOTER --}}
<footer class="zt-footer">
    <span>Copyright &copy; {{ date('Y') }} <a href="{{ route('web.home') }}">ZT_SHOES</a>. All rights reserved.</span>
    <span>Anything you want</span>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.zt-dropdown-toggle').forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
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
</script>
@stack('scripts')
</body>
</html>