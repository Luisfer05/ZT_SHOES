@extends('plantilla.app')

@push('estilos')
<style>
    :root { --rose:#e8b4b8; --rose-light:#f5dde0; --rose-dark:#c47a82; --nude:#f0e6e0; --ink:#1a1212; }

    .rl-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
    .rl-title  { font-size:22px; font-weight:600; color:var(--ink); margin:0; }
    .rl-subtitle { font-size:13px; color:#999; margin-top:2px; }
    .rl-btn-new { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; background:var(--ink); color:#fff; border:none; border-radius:10px; font-size:13px; font-weight:500; cursor:pointer; text-decoration:none; transition:opacity 0.2s; }
    .rl-btn-new:hover { opacity:0.85; color:#fff; }

    .rl-toolbar { display:flex; gap:10px; align-items:center; background:#fff; border:0.5px solid #f0e0e2; border-radius:12px; padding:14px 16px; margin-bottom:16px; }
    .rl-search-wrap { flex:1; position:relative; }
    .rl-search-icon { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#bbb; pointer-events:none; }
    .rl-search-input { width:100%; padding:9px 12px 9px 36px; border:1.5px solid #f0dde0; border-radius:8px; font-size:13px; color:var(--ink); outline:none; background:#fdf8f8; transition:border-color 0.2s; font-family:inherit; }
    .rl-search-input:focus { border-color:var(--rose); }
    .rl-search-btn { padding:9px 20px; background:var(--ink); color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit; }

    .rl-alert { display:flex; align-items:center; gap:10px; padding:12px 16px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:10px; color:#166534; font-size:13px; margin-bottom:16px; }

    .rl-table-card { background:#fff; border:0.5px solid #f0e0e2; border-radius:14px; overflow:hidden; }
    .rl-table { width:100%; border-collapse:collapse; }
    .rl-table thead tr { border-bottom:0.5px solid #f0e0e2; background:#fdf8f8; }
    .rl-table th { padding:11px 16px; font-size:11px; font-weight:500; color:#aaa; text-transform:uppercase; letter-spacing:0.06em; text-align:left; }
    .rl-table td { padding:14px 16px; font-size:13px; color:var(--ink); border-bottom:0.5px solid #f5eaea; vertical-align:middle; }
    .rl-table tbody tr:last-child td { border-bottom:none; }
    .rl-table tbody tr:hover td { background:#fdf8f8; }

    .rl-role-name { display:flex; align-items:center; gap:10px; }
    .rl-role-icon { width:32px; height:32px; border-radius:8px; background:var(--rose-light); display:flex; align-items:center; justify-content:center; flex-shrink:0; }

    .rl-perm-badge { display:inline-flex; align-items:center; padding:3px 9px; background:#f5f0ff; color:#7c3aed; border-radius:6px; font-size:11px; font-weight:500; margin:2px; font-family:monospace; }
    .rl-perm-none { display:inline-flex; align-items:center; padding:3px 9px; background:#f3f4f6; color:#9ca3af; border-radius:6px; font-size:11px; }

    .rl-btn-edit { display:inline-flex; align-items:center; gap:5px; padding:6px 11px; background:#eff6ff; color:#1d4ed8; border:1px solid #bfdbfe; border-radius:8px; font-size:12px; font-weight:500; cursor:pointer; text-decoration:none; transition:all 0.15s; margin-right:4px; }
    .rl-btn-edit:hover { background:#dbeafe; color:#1d4ed8; }
    .rl-btn-delete { display:inline-flex; align-items:center; gap:5px; padding:6px 11px; background:#fef2f2; color:#dc2626; border:1px solid #fecaca; border-radius:8px; font-size:12px; font-weight:500; cursor:pointer; transition:all 0.15s; }
    .rl-btn-delete:hover { background:#fee2e2; }

    .rl-empty { padding:56px 20px; text-align:center; }
    .rl-empty-icon { width:52px; height:52px; background:#fdf0f0; border-radius:50%; margin:0 auto 14px; display:flex; align-items:center; justify-content:center; }

    .rl-footer { padding:14px 16px; border-top:0.5px solid #f5eaea; display:flex; justify-content:space-between; align-items:center; }
    .rl-count { font-size:12px; color:#aaa; }
    .rl-footer .pagination { margin:0; }
    .rl-footer .page-link { border-radius:8px !important; border-color:#f0e0e2; color:#888; font-size:12px; padding:5px 12px; }
    .rl-footer .page-item.active .page-link { background:var(--ink); border-color:var(--ink); color:#fff; }

    .rl-modal .modal-content { border:none; border-radius:16px; overflow:hidden; }
    .rl-modal .modal-header { background:#fff; border-bottom:0.5px solid #f5eaea; padding:18px 20px; }
    .rl-modal .modal-title { font-size:15px; font-weight:600; color:var(--ink); }
    .rl-modal .modal-body { padding:20px; }
    .rl-modal .modal-footer { border-top:0.5px solid #f5eaea; padding:14px 20px; }
    .rl-modal-warn { display:flex; align-items:center; gap:12px; padding:14px 16px; background:#fef2f2; border:1px solid #fecaca; border-radius:10px; font-size:13px; color:#991b1b; }
    .rl-modal-icon { width:36px; height:36px; border-radius:50%; background:#fee2e2; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .rl-modal-cancel { padding:9px 18px; background:transparent; color:#888; border:0.5px solid #ddd; border-radius:8px; font-size:13px; cursor:pointer; font-family:inherit; }
    .rl-modal-confirm { padding:9px 20px; background:#dc2626; color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit; }
</style>
@endpush

@section('contenido')
<div class="app-content">
    <div class="container-fluid">

        <div class="rl-header">
            <div>
                <h1 class="rl-title">Roles</h1>
                <p class="rl-subtitle">Gestión de roles y permisos del sistema</p>
            </div>
            @can('rol-create')
                <a href="{{ route('roles.create') }}" class="rl-btn-new">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nuevo rol
                </a>
            @endcan
        </div>

        <form action="{{ route('roles.index') }}" method="GET">
            <div class="rl-toolbar">
                <div class="rl-search-wrap">
                    <svg class="rl-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input class="rl-search-input" type="text" name="texto" placeholder="Buscar rol..." value="{{ $texto }}">
                </div>
                <button type="submit" class="rl-search-btn">Buscar</button>
            </div>
        </form>

        @if(Session::has('mensaje'))
            <div class="rl-alert">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                {{ Session::get('mensaje') }}
            </div>
        @endif

        <div class="rl-table-card">
            <table class="rl-table">
                <thead>
                    <tr>
                        <th>Opciones</th>
                        <th>#ID</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($registros) <= 0)
                        <tr><td colspan="4">
                            <div class="rl-empty">
                                <div class="rl-empty-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                </div>
                                <p style="font-size:14px;font-weight:600;color:var(--ink);margin-bottom:4px;">Sin roles</p>
                                <p style="font-size:12px;color:#999;">No hay registros que coincidan con la búsqueda</p>
                            </div>
                        </td></tr>
                    @else
                        @foreach($registros as $reg)
                        <tr>
                            <td>
                                @can('rol-edit')
                                    <a href="{{ route('roles.edit', $reg->id) }}" class="rl-btn-edit">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Editar
                                    </a>
                                @endcan
                                @can('rol-delete')
                                    <button class="rl-btn-delete" data-bs-toggle="modal" data-bs-target="#modal-eliminar-{{ $reg->id }}">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                        Eliminar
                                    </button>
                                @endcan
                            </td>
                            <td style="color:#aaa;font-weight:500;">#{{ $reg->id }}</td>
                            <td>
                                <div class="rl-role-name">
                                    <div class="rl-role-icon">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    </div>
                                    <span style="font-weight:500;">{{ $reg->name }}</span>
                                </div>
                            </td>
                            <td>
                                @if($reg->permissions->isNotEmpty())
                                    @foreach($reg->permissions as $perm)
                                        <span class="rl-perm-badge">{{ $perm->name }}</span>
                                    @endforeach
                                @else
                                    <span class="rl-perm-none">Sin permisos</span>
                                @endif
                            </td>
                        </tr>

                        @can('rol-delete')
                        <div class="modal fade rl-modal" id="modal-eliminar-{{ $reg->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('roles.destroy', $reg->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Eliminar rol</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="rl-modal-warn">
                                                <div class="rl-modal-icon">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                                </div>
                                                <div>
                                                    <p style="font-weight:600;margin:0 0 3px;">¿Eliminar el rol <strong>{{ $reg->name }}</strong>?</p>
                                                    <p style="font-size:12px;margin:0;opacity:0.8;">Los usuarios con este rol perderán sus permisos asociados.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="rl-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="rl-modal-confirm">Sí, eliminar</button>
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
            <div class="rl-footer">
                <span class="rl-count">{{ $registros->total() }} roles encontrados</span>
                {{ $registros->appends(['texto' => $texto])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('mnuSeguridad').classList.add('menu-open');
    document.getElementById('itemRole').classList.add('active');
</script>
@endpush