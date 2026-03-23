@extends('plantilla.app')

@push('estilos')
<style>
    :root { --rose:#e8b4b8; --rose-light:#f5dde0; --rose-dark:#c47a82; --nude:#f0e6e0; --ink:#1a1212; }

    .us-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
    .us-title  { font-size:22px; font-weight:600; color:var(--ink); margin:0; }
    .us-subtitle { font-size:13px; color:#999; margin-top:2px; }
    .us-btn-new {
        display:inline-flex; align-items:center; gap:7px;
        padding:10px 20px; background:var(--ink); color:#fff;
        border:none; border-radius:10px; font-size:13px; font-weight:500;
        cursor:pointer; text-decoration:none; transition:opacity 0.2s;
    }
    .us-btn-new:hover { opacity:0.85; color:#fff; }

    .us-toolbar {
        display:flex; gap:10px; align-items:center;
        background:#fff; border:0.5px solid #f0e0e2;
        border-radius:12px; padding:14px 16px; margin-bottom:16px;
    }
    .us-search-wrap { flex:1; position:relative; }
    .us-search-icon { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#bbb; pointer-events:none; }
    .us-search-input {
        width:100%; padding:9px 12px 9px 36px;
        border:1.5px solid #f0dde0; border-radius:8px;
        font-size:13px; color:var(--ink); outline:none;
        background:#fdf8f8; transition:border-color 0.2s; font-family:inherit;
    }
    .us-search-input:focus { border-color:var(--rose); }
    .us-search-btn {
        padding:9px 20px; background:var(--ink); color:#fff; border:none;
        border-radius:8px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit;
    }

    .us-alert {
        display:flex; align-items:center; gap:10px; padding:12px 16px;
        background:#f0fdf4; border:1px solid #bbf7d0; border-radius:10px;
        color:#166534; font-size:13px; margin-bottom:16px;
    }

    .us-table-card { background:#fff; border:0.5px solid #f0e0e2; border-radius:14px; overflow:hidden; }
    .us-table { width:100%; border-collapse:collapse; }
    .us-table thead tr { border-bottom:0.5px solid #f0e0e2; background:#fdf8f8; }
    .us-table th { padding:11px 16px; font-size:11px; font-weight:500; color:#aaa; text-transform:uppercase; letter-spacing:0.06em; text-align:left; white-space:nowrap; }
    .us-table td { padding:13px 16px; font-size:13px; color:var(--ink); border-bottom:0.5px solid #f5eaea; vertical-align:middle; }
    .us-table tbody tr:last-child td { border-bottom:none; }
    .us-table tbody tr:hover td { background:#fdf8f8; }

    .us-avatar {
        width:34px; height:34px; border-radius:50%;
        background:linear-gradient(135deg,#f5dde0,#e8b4b8);
        display:inline-flex; align-items:center; justify-content:center;
        font-size:13px; font-weight:600; color:#c47a82;
        margin-right:10px; vertical-align:middle; flex-shrink:0;
    }
    .us-name-wrap { display:flex; align-items:center; }

    .us-badge {
        display:inline-flex; align-items:center; padding:3px 10px;
        border-radius:20px; font-size:11px; font-weight:500; margin:2px;
    }
    .us-badge-role  { background:#f0e6ff; color:#7c3aed; }
    .us-badge-none  { background:#f3f4f6; color:#9ca3af; }
    .us-badge-activo   { background:#d1fae5; color:#065f46; }
    .us-badge-inactivo { background:#fee2e2; color:#991b1b; }
    .us-badge-activo::before, .us-badge-inactivo::before {
        content:''; width:6px; height:6px; border-radius:50%; display:inline-block; margin-right:5px;
    }
    .us-badge-activo::before   { background:#059669; }
    .us-badge-inactivo::before { background:#dc2626; }

    .us-btn-edit {
        display:inline-flex; align-items:center; gap:5px;
        padding:6px 11px; background:#eff6ff; color:#1d4ed8;
        border:1px solid #bfdbfe; border-radius:8px;
        font-size:12px; font-weight:500; cursor:pointer;
        text-decoration:none; transition:all 0.15s; margin-right:4px;
    }
    .us-btn-edit:hover { background:#dbeafe; color:#1d4ed8; }
    .us-btn-delete {
        display:inline-flex; align-items:center; gap:5px;
        padding:6px 11px; background:#fef2f2; color:#dc2626;
        border:1px solid #fecaca; border-radius:8px;
        font-size:12px; font-weight:500; cursor:pointer; transition:all 0.15s; margin-right:4px;
    }
    .us-btn-delete:hover { background:#fee2e2; }
    .us-btn-toggle-off {
        display:inline-flex; align-items:center; gap:5px;
        padding:6px 11px; background:#fef3c7; color:#92400e;
        border:1px solid #fde68a; border-radius:8px;
        font-size:12px; font-weight:500; cursor:pointer; transition:all 0.15s;
    }
    .us-btn-toggle-off:hover { background:#fde68a; }
    .us-btn-toggle-on {
        display:inline-flex; align-items:center; gap:5px;
        padding:6px 11px; background:#d1fae5; color:#065f46;
        border:1px solid #6ee7b7; border-radius:8px;
        font-size:12px; font-weight:500; cursor:pointer; transition:all 0.15s;
    }
    .us-btn-toggle-on:hover { background:#a7f3d0; }

    .us-empty { padding:56px 20px; text-align:center; }
    .us-empty-icon { width:52px; height:52px; background:#fdf0f0; border-radius:50%; margin:0 auto 14px; display:flex; align-items:center; justify-content:center; }

    .us-footer { padding:14px 16px; border-top:0.5px solid #f5eaea; display:flex; justify-content:space-between; align-items:center; }
    .us-count { font-size:12px; color:#aaa; }
    .us-footer .pagination { margin:0; }
    .us-footer .page-link { border-radius:8px !important; border-color:#f0e0e2; color:#888; font-size:12px; padding:5px 12px; }
    .us-footer .page-item.active .page-link { background:var(--ink); border-color:var(--ink); color:#fff; }

    /* Modales */
    .us-modal .modal-content { border:none; border-radius:16px; overflow:hidden; }
    .us-modal .modal-header { background:#fff; border-bottom:0.5px solid #f5eaea; padding:18px 20px; }
    .us-modal .modal-title { font-size:15px; font-weight:600; color:var(--ink); }
    .us-modal .modal-body { padding:20px; }
    .us-modal .modal-footer { border-top:0.5px solid #f5eaea; padding:14px 20px; }
    .us-modal-box {
        display:flex; align-items:center; gap:12px;
        padding:14px 16px; border-radius:10px; font-size:13px;
    }
    .us-modal-box.danger { background:#fef2f2; border:1px solid #fecaca; color:#991b1b; }
    .us-modal-box.warning { background:#fffbeb; border:1px solid #fde68a; color:#92400e; }
    .us-modal-box.success { background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; }
    .us-modal-icon { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .us-modal-icon.danger { background:#fee2e2; }
    .us-modal-icon.warning { background:#fef3c7; }
    .us-modal-icon.success { background:#dcfce7; }
    .us-modal-cancel { padding:9px 18px; background:transparent; color:#888; border:0.5px solid #ddd; border-radius:8px; font-size:13px; cursor:pointer; font-family:inherit; }
    .us-modal-confirm-red   { padding:9px 20px; background:#dc2626; color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit; }
    .us-modal-confirm-warn  { padding:9px 20px; background:#d97706; color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit; }
    .us-modal-confirm-green { padding:9px 20px; background:#059669; color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit; }
</style>
@endpush

@section('contenido')
<div class="app-content">
    <div class="container-fluid">

        <div class="us-header">
            <div>
                <h1 class="us-title">Usuarios</h1>
                <p class="us-subtitle">Gestión de cuentas y accesos</p>
            </div>
            @can('user-create')
                <a href="{{ route('usuarios.create') }}" class="us-btn-new">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nuevo usuario
                </a>
            @endcan
        </div>

        <form action="{{ route('usuarios.index') }}" method="GET">
            <div class="us-toolbar">
                <div class="us-search-wrap">
                    <svg class="us-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input class="us-search-input" type="text" name="texto" placeholder="Buscar por nombre o email..." value="{{ $texto }}">
                </div>
                <button type="submit" class="us-search-btn">Buscar</button>
            </div>
        </form>

        @if(Session::has('mensaje'))
            <div class="us-alert">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                {{ Session::get('mensaje') }}
            </div>
        @endif

        <div class="us-table-card">
            <table class="us-table">
                <thead>
                    <tr>
                        <th>Opciones</th>
                        <th>#ID</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($registros) <= 0)
                        <tr><td colspan="6">
                            <div class="us-empty">
                                <div class="us-empty-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                </div>
                                <p style="font-size:14px;font-weight:600;color:var(--ink);margin-bottom:4px;">Sin usuarios</p>
                                <p style="font-size:12px;color:#999;">No hay registros que coincidan con la búsqueda</p>
                            </div>
                        </td></tr>
                    @else
                        @foreach($registros as $reg)
                        <tr>
                            <td>
                                @can('user-edit')
                                    <a href="{{ route('usuarios.edit', $reg->id) }}" class="us-btn-edit">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Editar
                                    </a>
                                @endcan
                                @can('user-delete')
                                    <button class="us-btn-delete" data-bs-toggle="modal" data-bs-target="#modal-eliminar-{{ $reg->id }}">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                        Eliminar
                                    </button>
                                @endcan
                                @can('user-activate')
                                    <button class="{{ $reg->activo ? 'us-btn-toggle-off' : 'us-btn-toggle-on' }}"
                                            data-bs-toggle="modal" data-bs-target="#modal-toggle-{{ $reg->id }}">
                                        @if($reg->activo)
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                            Desactivar
                                        @else
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                            Activar
                                        @endif
                                    </button>
                                @endcan
                            </td>
                            <td style="color:#aaa;font-weight:500;">#{{ $reg->id }}</td>
                            <td>
                                <div class="us-name-wrap">
                                    <div class="us-avatar">{{ strtoupper(substr($reg->name, 0, 1)) }}</div>
                                    <span style="font-weight:500;">{{ $reg->name }}</span>
                                </div>
                            </td>
                            <td style="color:#888;">{{ $reg->email }}</td>
                            <td>
                                @if($reg->roles->isNotEmpty())
                                    @foreach($reg->roles as $role)
                                        <span class="us-badge us-badge-role">{{ $role->name }}</span>
                                    @endforeach
                                @else
                                    <span class="us-badge us-badge-none">Sin rol</span>
                                @endif
                            </td>
                            <td>
                                <span class="us-badge {{ $reg->activo ? 'us-badge-activo' : 'us-badge-inactivo' }}">
                                    {{ $reg->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                        </tr>

                        {{-- Modal Eliminar --}}
                        @can('user-delete')
                        <div class="modal fade us-modal" id="modal-eliminar-{{ $reg->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('usuarios.destroy', $reg->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Eliminar usuario</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="us-modal-box danger">
                                                <div class="us-modal-icon danger">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                                </div>
                                                <div>
                                                    <p style="font-weight:600;margin:0 0 3px;">¿Eliminar a <strong>{{ $reg->name }}</strong>?</p>
                                                    <p style="font-size:12px;margin:0;opacity:0.8;">Esta acción no se puede deshacer.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="us-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="us-modal-confirm-red">Sí, eliminar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endcan

                        {{-- Modal Toggle --}}
                        @can('user-activate')
                        <div class="modal fade us-modal" id="modal-toggle-{{ $reg->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('usuarios.toggle', $reg->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $reg->activo ? 'Desactivar' : 'Activar' }} usuario</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="us-modal-box {{ $reg->activo ? 'warning' : 'success' }}">
                                                <div class="us-modal-icon {{ $reg->activo ? 'warning' : 'success' }}">
                                                    @if($reg->activo)
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                                    @else
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p style="font-weight:600;margin:0 0 3px;">
                                                        ¿{{ $reg->activo ? 'Desactivar' : 'Activar' }} a <strong>{{ $reg->name }}</strong>?
                                                    </p>
                                                    <p style="font-size:12px;margin:0;opacity:0.8;">
                                                        {{ $reg->activo ? 'El usuario no podrá iniciar sesión.' : 'El usuario podrá iniciar sesión nuevamente.' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="us-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                                            @if($reg->activo)
                                                <button type="submit" class="us-modal-confirm-warn">Sí, desactivar</button>
                                            @else
                                                <button type="submit" class="us-modal-confirm-green">Sí, activar</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endcan

                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="us-footer">
                <span class="us-count">{{ $registros->total() }} usuarios encontrados</span>
                {{ $registros->appends(['texto' => $texto])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('mnuSeguridad').classList.add('menu-open');
    document.getElementById('itemUsuario').classList.add('active');
</script>
@endpush