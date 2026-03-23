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

    /* Alerta */
    .prf-alert {
        display: flex; align-items: center; gap: 10px;
        padding: 12px 16px; background: #f0fdf4;
        border: 1px solid #bbf7d0; border-radius: 10px;
        color: #166534; font-size: 13px; margin-bottom: 24px;
    }

    /* Cards */
    .prf-card {
        background: #fff; border: 0.5px solid #f0e0e2;
        border-radius: 16px; overflow: hidden; margin-bottom: 20px;
    }
    .prf-card-header {
        padding: 16px 20px; border-bottom: 0.5px solid #f5eaea;
        display: flex; align-items: center; gap: 10px;
    }
    .prf-card-icon {
        width: 32px; height: 32px; border-radius: 8px;
        background: var(--rose-light); display: flex;
        align-items: center; justify-content: center;
    }
    .prf-card-title {
        font-size: 14px; font-weight: 600; color: var(--ink); margin: 0;
    }
    .prf-card-subtitle {
        font-size: 12px; color: #aaa; margin: 2px 0 0;
    }
    .prf-card-body { padding: 20px; }

    /* Form fields */
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

    /* Hint */
    .prf-hint {
        font-size: 11px; color: #bbb; margin-top: 5px; display: flex; align-items: center; gap: 4px;
    }

    /* Grid */
    .prf-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media (max-width: 600px) { .prf-grid { grid-template-columns: 1fr; } }

    /* Password toggle */
    .prf-input-wrap { position: relative; }
    .prf-eye {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        cursor: pointer; color: #bbb; transition: color 0.15s;
        background: none; border: none; padding: 0;
    }
    .prf-eye:hover { color: var(--rose-dark); }
    .prf-input-wrap .prf-input { padding-right: 40px; }

    /* Actions */
    .prf-actions {
        display: flex; justify-content: flex-end; gap: 10px;
        padding-top: 8px;
    }
    .prf-btn-cancel {
        padding: 10px 22px; background: transparent; color: #888;
        border: 1.5px solid #e8e0e0; border-radius: 10px;
        font-size: 13px; font-weight: 500; cursor: pointer;
        font-family: inherit; transition: all 0.15s;
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

    /* Info badge */
    .prf-role-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 12px; background: var(--rose-light);
        color: var(--rose-dark); border-radius: 20px;
        font-size: 11px; font-weight: 500; margin-top: 8px;
    }
</style>
@endpush

@section('contenido')
<div class="app-content">
    <div class="container-fluid">
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