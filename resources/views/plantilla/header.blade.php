<style>
    /* ── HEADER ADMIN ZT_SHOES ── */
    .app-header.navbar {
        background: #1a1212 !important;
        border-bottom: 1px solid rgba(232,180,184,0.15) !important;
        height: 56px;
    }
    .app-header .nav-link {
        color: rgba(255,255,255,0.6) !important;
        font-size: 13px;
        transition: color 0.2s;
    }
    .app-header .nav-link:hover { color: #e8b4b8 !important; }

    /* Logo ZT en el header */
    .zt-admin-brand {
        font-family: Georgia, serif;
        font-size: 16px;
        font-weight: 600;
        color: #fff !important;
        letter-spacing: 0.08em;
        padding: 0 20px 0 8px;
        border-right: 1px solid rgba(255,255,255,0.1);
        margin-right: 8px;
        text-decoration: none;
    }
    .zt-admin-brand span { color: #e8b4b8; }

    /* Links de navegación central */
    .zt-nav-center { display: flex; gap: 4px; }
    .zt-nav-center .nav-link {
        padding: 6px 14px !important;
        border-radius: 6px;
        font-size: 13px;
        color: rgba(255,255,255,0.55) !important;
    }
    .zt-nav-center .nav-link:hover {
        background: rgba(232,180,184,0.12);
        color: #e8b4b8 !important;
    }

    /* Dropdown usuario */
    .zt-user-btn {
        display: flex !important;
        align-items: center;
        gap: 8px;
        padding: 6px 14px !important;
        border-radius: 8px;
        color: rgba(255,255,255,0.8) !important;
        transition: background 0.2s;
    }
    .zt-user-btn:hover { background: rgba(255,255,255,0.08) !important; }
    .zt-user-avatar {
        width: 28px; height: 28px; border-radius: 50%;
        background: #e8b4b8; color: #1a1212;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 600;
    }

    /* Dropdown menú */
    .zt-admin-dropdown {
        border: 0.5px solid rgba(232,180,184,0.3) !important;
        border-radius: 12px !important;
        overflow: hidden;
        min-width: 200px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.3) !important;
        background: #221818 !important;
        padding: 6px !important;
        margin-top: 6px !important;
    }

    /* Cabecera del dropdown */
    .zt-dropdown-head {
        padding: 14px 16px 12px;
        border-bottom: 0.5px solid rgba(255,255,255,0.08);
        margin-bottom: 6px;
    }
    .zt-dropdown-head-name {
        font-size: 14px; font-weight: 500; color: #fff; margin: 0 0 2px;
    }
    .zt-dropdown-head-role {
        font-size: 11px; color: rgba(232,180,184,0.7); margin: 0;
    }

    /* Items del dropdown */
    .zt-admin-dropdown .dropdown-item {
        display: flex !important;
        align-items: center;
        gap: 10px;
        padding: 9px 14px !important;
        font-size: 13px !important;
        color: rgba(255,255,255,0.65) !important;
        border-radius: 8px !important;
        transition: background 0.15s, color 0.15s !important;
    }
    .zt-admin-dropdown .dropdown-item:hover {
        background: rgba(232,180,184,0.12) !important;
        color: #e8b4b8 !important;
    }
    .zt-admin-dropdown .dropdown-item.danger:hover {
        background: rgba(220,38,38,0.12) !important;
        color: #fca5a5 !important;
    }
    .zt-admin-dropdown .dropdown-divider {
        border-color: rgba(255,255,255,0.07) !important;
        margin: 4px 0 !important;
    }
    .zt-item-icon {
        width: 16px; height: 16px; opacity: 0.7; flex-shrink: 0;
    }
</style>

<nav class="app-header navbar navbar-expand bg-secondary">
    <div class="container-fluid">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        {{-- Links centrales --}}
        <ul class="navbar-nav mx-auto zt-nav-center">
            
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('web.home') }}" class="nav-link">Inicio</a>
            </li>
            @hasrole('admin')
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            </li>
            @endhasrole
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('perfil.pedidos') }}" class="nav-link">Pedidos</a>
            </li>
            @can('producto-list')
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('productos.index') }}" class="nav-link">Productos</a>
            </li>
            @endcan
        </ul>

        {{-- Menú derecha --}}
        <ul class="navbar-nav ms-auto">

            {{-- Fullscreen --}}
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display:none"></i>
                </a>
            </li>

            {{-- Usuario --}}
            @if(Auth::check())
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle zt-user-btn" data-bs-toggle="dropdown">
                    <div class="zt-user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="d-none d-md-inline" style="font-size:13px;">{{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end zt-admin-dropdown">
                    {{-- Cabecera --}}
                    <li>
                        <div class="zt-dropdown-head">
                            <p class="zt-dropdown-head-name">{{ Auth::user()->name }}</p>
                            <p class="zt-dropdown-head-role">{{ Auth::user()->email }}</p>
                        </div>
                    </li>

                    {{-- Links --}}
                    <li>
                        <a href="{{ route('web.home') }}" class="dropdown-item">
                            <svg class="zt-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Ver tienda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('perfil.edit') }}" class="dropdown-item">
                            <svg class="zt-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Mi perfil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('perfil.pedidos') }}" class="dropdown-item">
                            <svg class="zt-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            Mis pedidos
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a href="#" class="dropdown-item danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                            <svg class="zt-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            Cerrar sesión
                        </a>
                    </li>
                    <form action="{{ route('logout') }}" id="logout-form-header" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </li>
            @endif

        </ul>
    </div>
</nav>