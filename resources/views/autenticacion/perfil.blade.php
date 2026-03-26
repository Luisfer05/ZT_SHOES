@extends('plantilla.app')

@push('estilos')
<style>
    :root {
        --rose: #e8b4b8;
        --rose-light: #f5dde0;
        --rose-dark: #c47a82;
        --nude: #f0e6e0;
        --ink: #1a1212;
    }

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    .prf-layout {
        max-width: 900px;
        margin: 0 auto;
        padding: 32px 20px;
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 24px;
        align-items: start;
    }
    @media (max-width: 768px) {
        .prf-layout { grid-template-columns: 1fr; }
        .prf-sidebar { display: flex; gap: 8px; flex-wrap: wrap; }
        .prf-nav-item { flex: 1; min-width: 120px; }
    }

    /* ── Sidebar de cuenta ── */
    .prf-sidebar {
        background: #fff;
        border: 0.5px solid #f0e0e2;
        border-radius: 16px;
        overflow: hidden;
        position: sticky;
        top: 20px;
    }

    .prf-sidebar-top {
        padding: 20px 16px 16px;
        border-bottom: 0.5px solid #f5eaea;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        text-align: center;
    }
    .prf-avatar {
        width: 60px; height: 60px; border-radius: 50%;
        background: linear-gradient(135deg, #f5dde0, #e8b4b8);
        display: flex; align-items: center; justify-content: center;
        font-family: Georgia, serif; font-size: 24px; font-weight: 600;
        color: #c47a82; flex-shrink: 0;
        box-shadow: 0 0 0 3px rgba(232,180,184,0.4);
    }
    .prf-sidebar-name { font-size: 14px; font-weight: 600; color: var(--ink); margin: 0; }
    .prf-sidebar-email { font-size: 11px; color: #aaa; margin: 0; }
    .prf-role-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 3px 10px; background: var(--rose-light);
        color: var(--rose-dark); border-radius: 20px;
        font-size: 10px; font-weight: 500;
    }

    .prf-nav { padding: 8px; }
    .prf-nav-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 10px;
        font-size: 13px; color: rgba(26,18,18,0.55);
        text-decoration: none; transition: all 0.15s;
        cursor: pointer;
    }
    .prf-nav-item:hover { background: #fdf8f8; color: var(--ink); }
    .prf-nav-item.active { background: rgba(232,180,184,0.14); color: var(--rose-dark); font-weight: 500; }
    .prf-nav-icon { width: 16px; height: 16px; flex-shrink: 0; opacity: 0.6; }
    .prf-nav-item.active .prf-nav-icon,
    .prf-nav-item:hover .prf-nav-icon { opacity: 1; }

    .prf-nav-divider { height: 0.5px; background: #f5eaea; margin: 6px 0; }

    .prf-nav-item.danger { color: #dc2626; }
    .prf-nav-item.danger:hover { background: #fff0f0; }

    /* ── Contenido principal ── */
    .prf-main {}
<<<<<<< HEAD
=======
=======
    .prf-wrapper {
        max-width: 760px;
        margin: 0 auto;
        padding: 32px 20px;
    }

    /* Header */
    .prf-header {
        display: flex; align-items: center; gap: 20px;
        margin-bottom: 32px;
    }
    .prf-avatar {
        width: 72px; height: 72px; border-radius: 50%;
        background: linear-gradient(135deg, #f5dde0, #e8b4b8);
        display: flex; align-items: center; justify-content: center;
        font-family: Georgia, serif; font-size: 28px; font-weight: 600;
        color: #c47a82; flex-shrink: 0;
        border: 3px solid #fff;
        box-shadow: 0 0 0 2px #e8b4b8;
    }
    .prf-header-info h1 {
        font-size: 20px; font-weight: 600; color: var(--ink); margin: 0 0 4px;
    }
    .prf-header-info p {
        font-size: 13px; color: #999; margin: 0;
    }
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661

    /* Alerta */
    .prf-alert {
        display: flex; align-items: center; gap: 10px;
        padding: 12px 16px; background: #f0fdf4;
        border: 1px solid #bbf7d0; border-radius: 10px;
<<<<<<< HEAD
        color: #166534; font-size: 13px; margin-bottom: 20px;
=======
<<<<<<< HEAD
        color: #166534; font-size: 13px; margin-bottom: 20px;
=======
        color: #166534; font-size: 13px; margin-bottom: 24px;
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    }

    /* Cards */
    .prf-card {
        background: #fff; border: 0.5px solid #f0e0e2;
<<<<<<< HEAD
        border-radius: 16px; overflow: hidden; margin-bottom: 16px;
=======
<<<<<<< HEAD
        border-radius: 16px; overflow: hidden; margin-bottom: 16px;
=======
        border-radius: 16px; overflow: hidden; margin-bottom: 20px;
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    }
    .prf-card-header {
        padding: 16px 20px; border-bottom: 0.5px solid #f5eaea;
        display: flex; align-items: center; gap: 10px;
    }
    .prf-card-icon {
        width: 32px; height: 32px; border-radius: 8px;
        background: var(--rose-light); display: flex;
        align-items: center; justify-content: center;
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
        flex-shrink: 0;
    }
    .prf-card-title { font-size: 14px; font-weight: 600; color: var(--ink); margin: 0; }
    .prf-card-subtitle { font-size: 12px; color: #aaa; margin: 2px 0 0; }
    .prf-card-body { padding: 20px; }

    /* Fields */
<<<<<<< HEAD
=======
=======
    }
    .prf-card-title {
        font-size: 14px; font-weight: 600; color: var(--ink); margin: 0;
    }
    .prf-card-subtitle {
        font-size: 12px; color: #aaa; margin: 2px 0 0;
    }
    .prf-card-body { padding: 20px; }

    /* Form fields */
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    .prf-field { margin-bottom: 18px; }
    .prf-label {
        display: block; font-size: 12px; font-weight: 500;
        color: #888; text-transform: uppercase; letter-spacing: 0.06em;
        margin-bottom: 7px;
    }
    .prf-input {
        width: 100%; padding: 11px 14px;
        border: 1.5px solid #f0dde0; border-radius: 10px;
        font-size: 14px; color: var(--ink);
        background: #fdf8f8; outline: none;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .prf-input:focus {
        border-color: var(--rose);
        box-shadow: 0 0 0 3px rgba(232,180,184,0.15);
        background: #fff;
    }
    .prf-input.is-invalid { border-color: #fca5a5; }
    .prf-error { font-size: 12px; color: #dc2626; margin-top: 5px; display: block; }
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    .prf-hint { font-size: 11px; color: #bbb; margin-top: 5px; display: flex; align-items: center; gap: 4px; }

    .prf-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media (max-width: 600px) { .prf-grid { grid-template-columns: 1fr; } }

<<<<<<< HEAD
=======
=======

    /* Hint */
    .prf-hint {
        font-size: 11px; color: #bbb; margin-top: 5px; display: flex; align-items: center; gap: 4px;
    }

    /* Grid */
    .prf-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media (max-width: 600px) { .prf-grid { grid-template-columns: 1fr; } }

    /* Password toggle */
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    .prf-input-wrap { position: relative; }
    .prf-eye {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        cursor: pointer; color: #bbb; transition: color 0.15s;
        background: none; border: none; padding: 0;
    }
    .prf-eye:hover { color: var(--rose-dark); }
    .prf-input-wrap .prf-input { padding-right: 40px; }

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
    /* Actions */
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    .prf-actions {
        display: flex; justify-content: flex-end; gap: 10px;
        padding-top: 8px;
    }
    .prf-btn-cancel {
        padding: 10px 22px; background: transparent; color: #888;
        border: 1.5px solid #e8e0e0; border-radius: 10px;
        font-size: 13px; font-weight: 500; cursor: pointer;
        font-family: inherit; transition: all 0.15s;
<<<<<<< HEAD
        text-decoration: none; display: inline-flex; align-items: center;
=======
<<<<<<< HEAD
        text-decoration: none; display: inline-flex; align-items: center;
=======
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    }
    .prf-btn-cancel:hover { background: #f5f0f0; color: var(--ink); }
    .prf-btn-save {
        padding: 10px 26px; background: var(--ink); color: #fff;
        border: none; border-radius: 10px;
        font-size: 13px; font-weight: 500; cursor: pointer;
        font-family: inherit; transition: opacity 0.2s;
        display: flex; align-items: center; gap: 7px;
    }
    .prf-btn-save:hover { opacity: 0.85; }
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======

    /* Info badge */
    .prf-role-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 12px; background: var(--rose-light);
        color: var(--rose-dark); border-radius: 20px;
        font-size: 11px; font-weight: 500; margin-top: 8px;
    }
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
</style>
@endpush

@section('contenido')
<div class="app-content">
    <div class="container-fluid">
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
        <div class="prf-layout">

            {{-- ── SIDEBAR DE CUENTA ── --}}
            <aside class="prf-sidebar">
                <div class="prf-sidebar-top">
                    <div class="prf-avatar">
                        {{ strtoupper(substr($registro->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="prf-sidebar-name">{{ $registro->name }}</p>
                        <p class="prf-sidebar-email">{{ $registro->email }}</p>
                        @foreach($registro->roles as $role)
                            <span class="prf-role-badge">
                                <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <nav class="prf-nav">
                    <a href="{{ route('perfil.edit') }}" class="prf-nav-item active">
                        <svg class="prf-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                        Mi perfil
                    </a>
                    <a href="{{ route('perfil.pedidos') }}" class="prf-nav-item">
                        <svg class="prf-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                        Mis pedidos
                    </a>
                    <a href="{{ route('tienda') }}" class="prf-nav-item">
                        <svg class="prf-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                        </svg>
                        Ir a la tienda
                    </a>

                    <div class="prf-nav-divider"></div>

                    <a href="#" class="prf-nav-item danger"
                       onclick="event.preventDefault(); document.getElementById('logout-prf').submit();">
                        <svg class="prf-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Cerrar sesión
                    </a>
                    <form id="logout-prf" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </nav>
            </aside>

            {{-- ── CONTENIDO PRINCIPAL ── --}}
            <div class="prf-main">

                @if(session('mensaje'))
                    <div class="prf-alert">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        {{ session('mensaje') }}
                    </div>
                @endif

                <form action="{{ route('perfil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- INFORMACIÓN PERSONAL --}}
                    <div class="prf-card">
                        <div class="prf-card-header">
                            <div class="prf-card-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="prf-card-title">Información personal</p>
                                <p class="prf-card-subtitle">Nombre y correo electrónico</p>
                            </div>
                        </div>
                        <div class="prf-card-body">
                            <div class="prf-grid">
                                <div class="prf-field">
                                    <label class="prf-label" for="name">Nombre completo</label>
                                    <input class="prf-input @error('name') is-invalid @enderror"
                                           type="text" id="name" name="name"
                                           value="{{ old('name', $registro->name ?? '') }}" required>
                                    @error('name')
                                        <span class="prf-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="prf-field">
                                    <label class="prf-label" for="email">Correo electrónico</label>
                                    <input class="prf-input @error('email') is-invalid @enderror"
                                           type="email" id="email" name="email"
                                           value="{{ old('email', $registro->email ?? '') }}" required>
                                    @error('email')
                                        <span class="prf-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SEGURIDAD --}}
                    <div class="prf-card">
                        <div class="prf-card-header">
                            <div class="prf-card-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="prf-card-title">Seguridad</p>
                                <p class="prf-card-subtitle">Deja en blanco para mantener la contraseña actual</p>
                            </div>
                        </div>
                        <div class="prf-card-body">
                            <div class="prf-grid">
                                <div class="prf-field">
                                    <label class="prf-label" for="password">Nueva contraseña</label>
                                    <div class="prf-input-wrap">
                                        <input class="prf-input @error('password') is-invalid @enderror"
                                               type="password" id="password" name="password"
                                               value="{{ old('password') }}" autocomplete="new-password">
                                        <button type="button" class="prf-eye" onclick="togglePass('password', this)">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="prf-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="prf-field">
                                    <label class="prf-label" for="password_confirmation">Confirmar contraseña</label>
                                    <div class="prf-input-wrap">
                                        <input class="prf-input @error('password_confirmation') is-invalid @enderror"
                                               type="password" id="password_confirmation" name="password_confirmation"
                                               value="{{ old('password_confirmation') }}" autocomplete="new-password">
                                        <button type="button" class="prf-eye" onclick="togglePass('password_confirmation', this)">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="prf-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <p class="prf-hint">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                Mínimo 8 caracteres. Si no deseas cambiarla, deja estos campos vacíos.
                            </p>
                        </div>
                    </div>

                    {{-- ACCIONES --}}
                    <div class="prf-actions">
                        <a href="{{ route('perfil.pedidos') }}" class="prf-btn-cancel">Cancelar</a>
                        <button type="submit" class="prf-btn-save">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Guardar cambios
                        </button>
                    </div>

                </form>
            </div>

<<<<<<< HEAD
=======
=======
        <div class="prf-wrapper">

            {{-- HEADER --}}
            <div class="prf-header">
                <div class="prf-avatar">
                    {{ strtoupper(substr($registro->name, 0, 1)) }}
                </div>
                <div class="prf-header-info">
                    <h1>{{ $registro->name }}</h1>
                    <p>{{ $registro->email }}</p>
                    @foreach($registro->roles as $role)
                        <span class="prf-role-badge">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                            {{ $role->name }}
                        </span>
                    @endforeach
                </div>
            </div>

            {{-- ALERTA --}}
            @if(session('mensaje'))
                <div class="prf-alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    {{ session('mensaje') }}
                </div>
            @endif

            <form action="{{ route('perfil.update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- INFORMACIÓN PERSONAL --}}
                <div class="prf-card">
                    <div class="prf-card-header">
                        <div class="prf-card-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="prf-card-title">Información personal</p>
                            <p class="prf-card-subtitle">Nombre y correo electrónico</p>
                        </div>
                    </div>
                    <div class="prf-card-body">
                        <div class="prf-grid">
                            <div class="prf-field">
                                <label class="prf-label" for="name">Nombre completo</label>
                                <input class="prf-input @error('name') is-invalid @enderror"
                                       type="text" id="name" name="name"
                                       value="{{ old('name', $registro->name ?? '') }}" required>
                                @error('name')
                                    <span class="prf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="prf-field">
                                <label class="prf-label" for="email">Correo electrónico</label>
                                <input class="prf-input @error('email') is-invalid @enderror"
                                       type="email" id="email" name="email"
                                       value="{{ old('email', $registro->email ?? '') }}" required>
                                @error('email')
                                    <span class="prf-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEGURIDAD --}}
                <div class="prf-card">
                    <div class="prf-card-header">
                        <div class="prf-card-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="prf-card-title">Seguridad</p>
                            <p class="prf-card-subtitle">Deja en blanco para mantener la contraseña actual</p>
                        </div>
                    </div>
                    <div class="prf-card-body">
                        <div class="prf-grid">
                            <div class="prf-field">
                                <label class="prf-label" for="password">Nueva contraseña</label>
                                <div class="prf-input-wrap">
                                    <input class="prf-input @error('password') is-invalid @enderror"
                                           type="password" id="password" name="password"
                                           value="{{ old('password') }}" autocomplete="new-password">
                                    <button type="button" class="prf-eye" onclick="togglePass('password', this)">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="prf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="prf-field">
                                <label class="prf-label" for="password_confirmation">Confirmar contraseña</label>
                                <div class="prf-input-wrap">
                                    <input class="prf-input @error('password_confirmation') is-invalid @enderror"
                                           type="password" id="password_confirmation" name="password_confirmation"
                                           value="{{ old('password_confirmation') }}" autocomplete="new-password">
                                    <button type="button" class="prf-eye" onclick="togglePass('password_confirmation', this)">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <span class="prf-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <p class="prf-hint">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            Mínimo 8 caracteres. Si no deseas cambiarla, deja estos campos vacíos.
                        </p>
                    </div>
                </div>

                {{-- ACCIONES --}}
                <div class="prf-actions">
                    <button type="button" class="prf-btn-cancel"
                            onclick="window.location.href='{{ route('dashboard') }}'">
                        Cancelar
                    </button>
                    <button type="submit" class="prf-btn-save">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Guardar cambios
                    </button>
                </div>

            </form>
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePass(id, btn) {
    var input = document.getElementById(id);
    var isPass = input.type === 'password';
    input.type = isPass ? 'text' : 'password';
    btn.style.color = isPass ? '#c47a82' : '#bbb';
}
</script>
@endpush