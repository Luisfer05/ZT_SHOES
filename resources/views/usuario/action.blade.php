@extends('plantilla.app')

@push('estilos')
<style>
    :root { --rose:#e8b4b8; --rose-light:#f5dde0; --rose-dark:#c47a82; --nude:#f0e6e0; --ink:#1a1212; }
    .ua-wrapper { max-width:760px; margin:0 auto; padding:32px 20px; }
    .ua-header { display:flex; align-items:center; gap:14px; margin-bottom:28px; }
    .ua-back { width:36px; height:36px; border-radius:10px; background:#fff; border:0.5px solid #f0e0e2; display:flex; align-items:center; justify-content:center; cursor:pointer; text-decoration:none; color:#888; transition:all 0.15s; flex-shrink:0; }
    .ua-back:hover { background:var(--nude); color:var(--ink); border-color:var(--rose); }
    .ua-title { font-size:20px; font-weight:600; color:var(--ink); margin:0 0 2px; }
    .ua-subtitle { font-size:13px; color:#aaa; margin:0; }

    .ua-card { background:#fff; border:0.5px solid #f0e0e2; border-radius:16px; overflow:hidden; margin-bottom:16px; }
    .ua-card-header { padding:15px 20px; border-bottom:0.5px solid #f5eaea; display:flex; align-items:center; gap:10px; }
    .ua-card-icon { width:32px; height:32px; border-radius:8px; background:var(--rose-light); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .ua-card-title { font-size:14px; font-weight:600; color:var(--ink); margin:0; }
    .ua-card-body { padding:20px; }

    .ua-grid-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; }
    .ua-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    @media(max-width:640px) { .ua-grid-3,.ua-grid-2 { grid-template-columns:1fr; } }

    .ua-field { margin-bottom:4px; }
    .ua-label { display:block; font-size:12px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:7px; }
    .ua-input, .ua-select {
        width:100%; padding:11px 14px; border:1.5px solid #f0dde0; border-radius:10px;
        font-size:14px; color:var(--ink); background:#fdf8f8; outline:none;
        font-family:inherit; transition:border-color 0.2s, box-shadow 0.2s;
        appearance:none;
    }
    .ua-input:focus, .ua-select:focus { border-color:var(--rose); box-shadow:0 0 0 3px rgba(232,180,184,0.15); background:#fff; }
    .ua-input.is-invalid, .ua-select.is-invalid { border-color:#fca5a5; }
    .ua-error { font-size:12px; color:#dc2626; margin-top:5px; display:block; }

    .ua-input-wrap { position:relative; }
    .ua-eye { position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; color:#bbb; background:none; border:none; padding:0; transition:color 0.15s; }
    .ua-eye:hover { color:var(--rose-dark); }
    .ua-input-wrap .ua-input { padding-right:40px; }

    .ua-select-wrap { position:relative; }
    .ua-select-wrap::after { content:'▾'; position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#bbb; pointer-events:none; font-size:12px; }

    .ua-hint { font-size:11px; color:#bbb; margin-top:5px; display:flex; align-items:center; gap:4px; }

    .ua-actions { display:flex; justify-content:flex-end; gap:10px; margin-top:8px; }
    .ua-btn-cancel { padding:11px 22px; background:transparent; color:#888; border:1.5px solid #e8e0e0; border-radius:10px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit; transition:all 0.15s; }
    .ua-btn-cancel:hover { background:#f5f0f0; color:var(--ink); }
    .ua-btn-save { padding:11px 26px; background:var(--ink); color:#fff; border:none; border-radius:10px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit; display:flex; align-items:center; gap:7px; transition:opacity 0.2s; }
    .ua-btn-save:hover { opacity:0.85; }
</style>
@endpush

@section('contenido')
<div class="app-content">
    <div class="container-fluid">
        <div class="ua-wrapper">
            <div class="ua-header">
                <a href="{{ route('usuarios.index') }}" class="ua-back">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                </a>
                <div>
                    <h1 class="ua-title">{{ isset($registro) ? 'Editar usuario' : 'Nuevo usuario' }}</h1>
                    <p class="ua-subtitle">{{ isset($registro) ? 'Modificar datos de ' . $registro->name : 'Crear una nueva cuenta de usuario' }}</p>
                </div>
            </div>

            <form action="{{ isset($registro) ? route('usuarios.update', $registro->id) : route('usuarios.store') }}" method="POST">
                @csrf
                @if(isset($registro)) @method('PUT') @endif

                {{-- INFO BÁSICA --}}
                <div class="ua-card">
                    <div class="ua-card-header">
                        <div class="ua-card-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <p class="ua-card-title">Información básica</p>
                    </div>
                    <div class="ua-card-body">
                        <div class="ua-grid-3">
                            <div class="ua-field">
                                <label class="ua-label" for="name">Nombre completo</label>
                                <input class="ua-input @error('name') is-invalid @enderror"
                                       type="text" id="name" name="name"
                                       value="{{ old('name', $registro->name ?? '') }}" required>
                                @error('name') <span class="ua-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="ua-field">
                                <label class="ua-label" for="email">Correo electrónico</label>
                                <input class="ua-input @error('email') is-invalid @enderror"
                                       type="email" id="email" name="email"
                                       value="{{ old('email', $registro->email ?? '') }}" required>
                                @error('email') <span class="ua-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="ua-field">
                                <label class="ua-label" for="activo">Estado</label>
                                <div class="ua-select-wrap">
                                    <select class="ua-select @error('activo') is-invalid @enderror" id="activo" name="activo">
                                        <option value="1" {{ old('activo', $registro->activo ?? '1') == '1' ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ old('activo', $registro->activo ?? '1') == '0' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                                @error('activo') <span class="ua-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEGURIDAD --}}
                <div class="ua-card">
                    <div class="ua-card-header">
                        <div class="ua-card-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <p class="ua-card-title">Contraseña {{ isset($registro) ? '— dejar en blanco para mantener' : '' }}</p>
                    </div>
                    <div class="ua-card-body">
                        <div class="ua-grid-2">
                            <div class="ua-field">
                                <label class="ua-label" for="password">{{ isset($registro) ? 'Nueva contraseña' : 'Contraseña' }}</label>
                                <div class="ua-input-wrap">
                                    <input class="ua-input @error('password') is-invalid @enderror"
                                           type="password" id="password" name="password" autocomplete="new-password"
                                           {{ !isset($registro) ? 'required' : '' }}>
                                    <button type="button" class="ua-eye" onclick="togglePass('password',this)">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                                @error('password') <span class="ua-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="ua-field">
                                <label class="ua-label" for="password_confirmation">Confirmar contraseña</label>
                                <div class="ua-input-wrap">
                                    <input class="ua-input @error('password_confirmation') is-invalid @enderror"
                                           type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                                           {{ !isset($registro) ? 'required' : '' }}>
                                    <button type="button" class="ua-eye" onclick="togglePass('password_confirmation',this)">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                                @error('password_confirmation') <span class="ua-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ROL --}}
                <div class="ua-card">
                    <div class="ua-card-header">
                        <div class="ua-card-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <p class="ua-card-title">Rol del usuario</p>
                    </div>
                    <div class="ua-card-body">
                        <div style="max-width:280px;">
                            <label class="ua-label" for="role">Asignar rol</label>
                            <div class="ua-select-wrap">
                                <select name="role" id="role" class="ua-select">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ isset($registro) && $registro->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ua-actions">
                    <button type="button" class="ua-btn-cancel" onclick="window.location.href='{{ route('usuarios.index') }}'">Cancelar</button>
                    <button type="submit" class="ua-btn-save">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ isset($registro) ? 'Guardar cambios' : 'Crear usuario' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('mnuSeguridad').classList.add('menu-open');
    document.getElementById('itemUsuario').classList.add('active');
    function togglePass(id, btn) {
        var input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.style.color = input.type === 'text' ? '#c47a82' : '#bbb';
    }
</script>
@endpush