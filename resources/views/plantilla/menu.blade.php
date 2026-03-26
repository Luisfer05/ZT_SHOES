<style>
    /* ── SIDEBAR ZT_SHOES ── */
    .app-sidebar {
        background: #1a1212 !important;
        border-right: 1px solid rgba(232,180,184,0.1) !important;
    }

    /* Brand */
    .sidebar-brand {
        background: #110c0c !important;
        border-bottom: 1px solid rgba(232,180,184,0.1) !important;
        padding: 0 16px !important;
        height: 56px;
        display: flex;
        align-items: center;
    }
    .zt-sidebar-logo {
        font-family: Georgia, serif;
        font-size: 18px;
        font-weight: 600;
        color: #fff !important;
        letter-spacing: 0.08em;
        text-decoration: none !important;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .zt-sidebar-logo span { color: #e8b4b8; }
    .zt-sidebar-logo-dot {
        width: 32px; height: 32px; border-radius: 50%;
        background: rgba(232,180,184,0.15);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    /* Scroll wrapper */
    .sidebar-wrapper {
        background: transparent !important;
    }

    /* Sección label */
    .zt-nav-label {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(232,180,184,0.4);
        padding: 18px 18px 6px;
        display: block;
    }

    /* Nav items */
    .sidebar-menu .nav-item { margin: 2px 8px; }

    .sidebar-menu .nav-link {
        display: flex !important;
        align-items: center;
        gap: 10px;
        padding: 10px 12px !important;
        border-radius: 8px !important;
        color: rgba(255,255,255,0.5) !important;
        font-size: 13px !important;
        font-weight: 400;
        transition: background 0.15s, color 0.15s !important;
        position: relative;
    }
    .sidebar-menu .nav-link:hover {
        background: rgba(232,180,184,0.08) !important;
        color: rgba(255,255,255,0.85) !important;
    }
    .sidebar-menu .nav-link.active {
        background: rgba(232,180,184,0.14) !important;
        color: #e8b4b8 !important;
    }
    .sidebar-menu .nav-link.active .nav-icon {
        color: #e8b4b8 !important;
    }

    /* Iconos */
    .sidebar-menu .nav-icon {
        font-size: 15px !important;
        width: 18px !important;
        color: rgba(255,255,255,0.35) !important;
        flex-shrink: 0;
        transition: color 0.15s;
    }
    .sidebar-menu .nav-link:hover .nav-icon {
        color: rgba(255,255,255,0.7) !important;
    }

    /* Flecha submenu */
    .sidebar-menu .nav-arrow {
        margin-left: auto !important;
        font-size: 11px !important;
        opacity: 0.4;
        transition: transform 0.2s;
    }
    .sidebar-menu .nav-item.menu-open > .nav-link .nav-arrow {
        transform: rotate(90deg);
    }

    /* Submenu */
    .sidebar-menu .nav-treeview {
        padding: 2px 0 4px 0 !important;
        background: transparent !important;
    }
    .sidebar-menu .nav-treeview .nav-item {
        margin: 1px 8px 1px 16px;
    }
    .sidebar-menu .nav-treeview .nav-link {
        padding: 8px 12px !important;
        font-size: 12px !important;
        color: rgba(255,255,255,0.4) !important;
    }
    .sidebar-menu .nav-treeview .nav-link:hover {
        color: rgba(255,255,255,0.75) !important;
        background: rgba(232,180,184,0.06) !important;
    }
    .sidebar-menu .nav-treeview .nav-link.active {
        color: #e8b4b8 !important;
        background: rgba(232,180,184,0.1) !important;
    }
    .sidebar-menu .nav-treeview .nav-icon {
        font-size: 6px !important;
        color: rgba(255,255,255,0.25) !important;
        width: 14px !important;
    }
    .sidebar-menu .nav-treeview .nav-link.active .nav-icon {
        color: #e8b4b8 !important;
        font-size: 8px !important;
    }

    /* Divider */
    .zt-sidebar-divider {
        height: 0.5px;
        background: rgba(255,255,255,0.06);
        margin: 8px 16px;
    }

    /* Footer del sidebar */
    .zt-sidebar-footer {
        padding: 12px 16px;
        border-top: 1px solid rgba(255,255,255,0.06);
        margin-top: auto;
    }
    .zt-sidebar-footer-text {
        font-size: 11px;
        color: rgba(232,180,184,0.3);
        text-align: center;
        font-family: Georgia, serif;
        letter-spacing: 0.05em;
    }
</style>

<aside class="app-sidebar shadow" data-bs-theme="dark">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <a href="{{ route('web.home') }}" class="zt-sidebar-logo">
            <div class="zt-sidebar-logo-dot">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#e8b4b8" stroke-width="2">
                    <path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/>
                </svg>
            </div>
            ZT <span>|</span> SHOES
        </a>
    </div>

    {{-- Sidebar Wrapper --}}
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                {{-- GENERAL --}}
                <span class="zt-nav-label">General</span>

                @hasrole('admin')
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link" id="mnuDashboard">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endhasrole

                <li class="nav-item">
                    <a href="{{ route('perfil.pedidos') }}" class="nav-link" id="mnuPedidos">
                        <i class="nav-icon bi bi-bag-fill"></i>
                        <p>Pedidos</p>
                    </a>
                </li>

                {{-- ADMINISTRACIÓN --}}
                @canany(['user-list', 'rol-list', 'producto-list'])
                    <div class="zt-sidebar-divider"></div>
                    <span class="zt-nav-label">Administración</span>
                @endcanany

                @canany(['user-list', 'rol-list'])
                <li class="nav-item" id="mnuSeguridad">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-shield-lock-fill"></i>
                        <p>
                            Seguridad
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('user-list')
                        <li class="nav-item">
                            <a href="{{ route('usuarios.index') }}" class="nav-link" id="itemUsuario">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        @endcan
                        @can('rol-list')
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link" id="itemRole">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @can('producto-list')
                <li class="nav-item" id="mnuAlmacen">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-archive-fill"></i>
                        <p>
                            Almacén
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('productos.index') }}" class="nav-link" id="itemProducto">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @hasrole('admin')
                <li class="nav-item">
                    <a href="{{ route('configuracion.moneda') }}" class="nav-link" id="mnuMoneda">
                        <i class="nav-icon bi bi-currency-exchange"></i>
                        <p>Moneda</p>
                    </a>
                </li>
                @endhasrole

            </ul>
        </nav>

        {{-- Footer --}}
        <div class="zt-sidebar-footer">
            <p class="zt-sidebar-footer-text">ZT | SHOES &copy; {{ date('Y') }}</p>
        </div>
    </div>
</aside>