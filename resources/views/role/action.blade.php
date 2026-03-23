@extends('plantilla.app')

@push('estilos')
<style>
    :root { --rose:#e8b4b8; --rose-light:#f5dde0; --rose-dark:#c47a82; --nude:#f0e6e0; --ink:#1a1212; }
    .ra-wrapper { max-width:760px; margin:0 auto; padding:32px 20px; }
    .ra-header { display:flex; align-items:center; gap:14px; margin-bottom:28px; }
    .ra-back { width:36px; height:36px; border-radius:10px; background:#fff; border:0.5px solid #f0e0e2; display:flex; align-items:center; justify-content:center; cursor:pointer; text-decoration:none; color:#888; transition:all 0.15s; flex-shrink:0; }
    .ra-back:hover { background:var(--nude); color:var(--ink); border-color:var(--rose); }
    .ra-title { font-size:20px; font-weight:600; color:var(--ink); margin:0 0 2px; }
    .ra-subtitle { font-size:13px; color:#aaa; margin:0; }

    .ra-card { background:#fff; border:0.5px solid #f0e0e2; border-radius:16px; overflow:hidden; margin-bottom:16px; }
    .ra-card-header { padding:15px 20px; border-bottom:0.5px solid #f5eaea; display:flex; align-items:center; gap:10px; }
    .ra-card-icon { width:32px; height:32px; border-radius:8px; background:var(--rose-light); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .ra-card-title { font-size:14px; font-weight:600; color:var(--ink); margin:0; }
    .ra-card-subtitle { font-size:12px; color:#aaa; margin:2px 0 0; }
    .ra-card-body { padding:20px; }

    .ra-label { display:block; font-size:12px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:7px; }
    .ra-input { width:100%; padding:11px 14px; border:1.5px solid #f0dde0; border-radius:10px; font-size:14px; color:var(--ink); background:#fdf8f8; outline:none; font-family:inherit; transition:border-color 0.2s, box-shadow 0.2s; max-width:360px; }
    .ra-input:focus { border-color:var(--rose); box-shadow:0 0 0 3px rgba(232,180,184,0.15); background:#fff; }
    .ra-input.is-invalid { border-color:#fca5a5; }
    .ra-error { font-size:12px; color:#dc2626; margin-top:5px; display:block; }

    /* Permisos grid */
    .ra-perms-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:8px; }
    .ra-perm-item {
        display:flex; align-items:center; gap:10px;
        padding:10px 14px; border:1.5px solid #f0dde0; border-radius:10px;
        cursor:pointer; transition:all 0.15s; background:#fdf8f8;
        user-select:none;
    }
    .ra-perm-item:hover { border-color:var(--rose); background:var(--rose-light); }
    .ra-perm-item input[type="checkbox"] { display:none; }
    .ra-perm-check {
        width:18px; height:18px; border-radius:5px; border:1.5px solid #e0d0d2;
        display:flex; align-items:center; justify-content:center;
        flex-shrink:0; transition:all 0.15s; background:#fff;
    }
    .ra-perm-item.checked { border-color:var(--rose); background:var(--rose-light); }
    .ra-perm-item.checked .ra-perm-check { background:var(--rose-dark); border-color:var(--rose-dark); }
    .ra-perm-label { font-size:12px; color:#666; font-family:monospace; font-weight:500; }
    .ra-perm-item.checked .ra-perm-label { color:var(--rose-dark); }

    .ra-select-actions { display:flex; gap:8px; margin-bottom:14px; }
    .ra-select-btn { padding:6px 14px; background:transparent; border:0.5px solid #e0d0d2; border-radius:8px; font-size:12px; color:#888; cursor:pointer; font-family:inherit; transition:all 0.15s; }
    .ra-select-btn:hover { border-color:var(--rose); color:var(--rose-dark); background:var(--rose-light); }

    .ra-actions { display:flex; justify-content:flex-end; gap:10px; margin-top:8px; }
    .ra-btn-cancel { padding:11px 22px; background:transparent; color:#888; border:1.5px solid #e8e0e0; border-radius:10px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit; transition:all 0.15s; }
    .ra-btn-cancel:hover { background:#f5f0f0; color:var(--ink); }
    .ra-btn-save { padding:11px 26px; background:var(--ink); color:#fff; border:none; border-radius:10px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit; display:flex; align-items:center; gap:7px; transition:opacity 0.2s; }
    .ra-btn-save:hover { opacity:0.85; }

    .ra-counter { font-size:12px; color:#aaa; margin-bottom:14px; }
    .ra-counter span { font-weight:600; color:var(--rose-dark); }
</style>
@endpush

@section('contenido')
<div class="app-content">
    <div class="container-fluid">
        <div class="ra-wrapper">

            <div class="ra-header">
                <a href="{{ route('roles.index') }}" class="ra-back">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                </a>
                <div>
                    <h1 class="ra-title">{{ isset($registro) ? 'Editar rol' : 'Nuevo rol' }}</h1>
                    <p class="ra-subtitle">{{ isset($registro) ? 'Modificar permisos de ' . $registro->name : 'Define un nuevo rol y sus permisos' }}</p>
                </div>
            </div>

            <form action="{{ isset($registro) ? route('roles.update', $registro->id) : route('roles.store') }}" method="POST">
                @csrf
                @if(isset($registro)) @method('PUT') @endif

                {{-- NOMBRE --}}
                <div class="ra-card">
                    <div class="ra-card-header">
                        <div class="ra-card-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div>
                            <p class="ra-card-title">Nombre del rol</p>
                            <p class="ra-card-subtitle">Usa un nombre descriptivo, ej: Admin, Editor, Vendedor</p>
                        </div>
                    </div>
                    <div class="ra-card-body">
                        <label class="ra-label" for="name">Nombre</label>
                        <input class="ra-input @error('name') is-invalid @enderror"
                               type="text" id="name" name="name"
                               value="{{ old('name', $registro->name ?? '') }}"
                               placeholder="Ej: Admin" required>
                        @error('name') <span class="ra-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- PERMISOS --}}
                <div class="ra-card">
                    <div class="ra-card-header">
                        <div class="ra-card-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <div>
                            <p class="ra-card-title">Permisos</p>
                            <p class="ra-card-subtitle">Selecciona los permisos que tendrá este rol</p>
                        </div>
                    </div>
                    <div class="ra-card-body">
                        <div class="ra-select-actions">
                            <button type="button" class="ra-select-btn" onclick="selectAll(true)">Seleccionar todos</button>
                            <button type="button" class="ra-select-btn" onclick="selectAll(false)">Deseleccionar todos</button>
                        </div>
                        <p class="ra-counter"><span id="perm-count">0</span> de {{ count($permissions) }} permisos seleccionados</p>

                        <div class="ra-perms-grid">
                            @foreach($permissions as $permission)
                            @php $checked = isset($registro) && $registro->hasPermissionTo($permission->name); @endphp
                            <label class="ra-perm-item {{ $checked ? 'checked' : '' }}" onclick="togglePerm(this)">
                                <input type="checkbox" name="permissions[]"
                                       value="{{ $permission->name }}"
                                       id="permiso_{{ $permission->id }}"
                                       {{ $checked ? 'checked' : '' }}>
                                <div class="ra-perm-check">
                                    @if($checked)
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                    @endif
                                </div>
                                <span class="ra-perm-label">{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="ra-actions">
                    <button type="button" class="ra-btn-cancel" onclick="window.location.href='{{ route('roles.index') }}'">Cancelar</button>
                    <button type="submit" class="ra-btn-save">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ isset($registro) ? 'Guardar cambios' : 'Crear rol' }}
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
    document.getElementById('itemRole').classList.add('active');

    function updateCount() {
        var count = document.querySelectorAll('.ra-perm-item.checked').length;
        document.getElementById('perm-count').textContent = count;
    }

    function togglePerm(label) {
        var cb = label.querySelector('input[type="checkbox"]');
        var check = label.querySelector('.ra-perm-check');
        cb.checked = !cb.checked;
        if (cb.checked) {
            label.classList.add('checked');
            check.innerHTML = '<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>';
        } else {
            label.classList.remove('checked');
            check.innerHTML = '';
        }
        updateCount();
    }

    function selectAll(val) {
        document.querySelectorAll('.ra-perm-item').forEach(function(label) {
            var cb = label.querySelector('input[type="checkbox"]');
            var check = label.querySelector('.ra-perm-check');
            cb.checked = val;
            if (val) {
                label.classList.add('checked');
                check.innerHTML = '<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>';
            } else {
                label.classList.remove('checked');
                check.innerHTML = '';
            }
        });
        updateCount();
    }

    updateCount();
</script>
@endpush