@extends('plantilla.app')

@push('estilos')
<style>
    :root {
        --rose: #e8b4b8; --rose-light: #f5dde0;
        --rose-dark: #c47a82; --nude: #f0e6e0;
        --ink: #1a1212;
    }
    .pr-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
    .pr-title { font-size:22px; font-weight:600; color:var(--ink); margin:0; }
    .pr-subtitle { font-size:13px; color:#999; margin-top:2px; }

    .pr-btn-new {
        display:inline-flex; align-items:center; gap:7px;
        padding:10px 20px; background:var(--ink); color:#fff;
        border:none; border-radius:10px; font-size:13px; font-weight:500;
        cursor:pointer; text-decoration:none; transition:opacity 0.2s;
    }
    .pr-btn-new:hover { opacity:0.85; color:#fff; }

    .pr-toolbar {
        display:flex; gap:10px; align-items:center;
        background:#fff; border:0.5px solid #f0e0e2;
        border-radius:12px; padding:14px 16px; margin-bottom:16px;
    }
    .pr-search-wrap { flex:1; position:relative; }
    .pr-search-icon { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#bbb; pointer-events:none; }
    .pr-search-input {
        width:100%; padding:9px 12px 9px 36px;
        border:1.5px solid #f0dde0; border-radius:8px;
        font-size:13px; color:var(--ink); outline:none;
        background:#fdf8f8; transition:border-color 0.2s; font-family:inherit;
    }
    .pr-search-input:focus { border-color:var(--rose); }
    .pr-search-btn {
        padding:9px 20px; background:var(--ink); color:#fff;
        border:none; border-radius:8px; font-size:13px;
        font-weight:500; cursor:pointer; white-space:nowrap; font-family:inherit;
    }

    .pr-alert {
        display:flex; align-items:center; gap:10px;
        padding:12px 16px; background:#f0fdf4;
        border:1px solid #bbf7d0; border-radius:10px;
        color:#166534; font-size:13px; margin-bottom:16px;
    }

    .pr-table-card {
        background:#fff; border:0.5px solid #f0e0e2;
        border-radius:14px; overflow:hidden;
    }
    .pr-table { width:100%; border-collapse:collapse; }
    .pr-table thead tr { border-bottom:0.5px solid #f0e0e2; background:#fdf8f8; }
    .pr-table th {
        padding:11px 16px; font-size:11px; font-weight:500; color:#aaa;
        text-transform:uppercase; letter-spacing:0.06em; text-align:left; white-space:nowrap;
    }
    .pr-table td {
        padding:13px 16px; font-size:13px; color:var(--ink);
        border-bottom:0.5px solid #f5eaea; vertical-align:middle;
    }
    .pr-table tbody tr:last-child td { border-bottom:none; }
    .pr-table tbody tr:hover td { background:#fdf8f8; }

    .pr-product-img {
        width:52px; height:52px; border-radius:10px;
        object-fit:cover; border:0.5px solid #f0e0e2;
    }
    .pr-no-img {
        width:52px; height:52px; border-radius:10px;
        background:var(--rose-light); display:flex;
        align-items:center; justify-content:center;
        font-size:22px;
    }

    .pr-code {
        display:inline-block; padding:3px 10px;
        background:#f5f0ff; color:#7c3aed;
        border-radius:6px; font-size:11px; font-weight:500;
        font-family:monospace; letter-spacing:0.04em;
    }
    .pr-price { font-weight:600; color:var(--ink); }

    .pr-btn-edit {
        display:inline-flex; align-items:center; gap:5px;
        padding:6px 12px; background:#eff6ff; color:#1d4ed8;
        border:1px solid #bfdbfe; border-radius:8px;
        font-size:12px; font-weight:500; cursor:pointer;
        text-decoration:none; transition:all 0.15s; margin-right:6px;
    }
    .pr-btn-edit:hover { background:#dbeafe; color:#1d4ed8; }
    .pr-btn-delete {
        display:inline-flex; align-items:center; gap:5px;
        padding:6px 12px; background:#fef2f2; color:#dc2626;
        border:1px solid #fecaca; border-radius:8px;
        font-size:12px; font-weight:500; cursor:pointer;
        transition:all 0.15s;
    }
    .pr-btn-delete:hover { background:#fee2e2; }

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    /* ── Botón colección ── */
    .pr-btn-coleccion {
        display:inline-flex; align-items:center; gap:5px;
        padding:6px 12px; border-radius:8px;
        font-size:12px; font-weight:500; cursor:pointer;
        border:1px solid #f0dde0; background:#fdf8f8; color:#999;
        transition:all 0.15s; margin-right:6px;
    }
    .pr-btn-coleccion:hover { border-color:var(--rose-dark); color:var(--rose-dark); background:#fff5f5; }
    .pr-btn-coleccion.activo {
        background:#fff7e6; color:#b45309;
        border-color:#fcd34d;
    }
    .pr-btn-coleccion.activo:hover { background:#fef3c7; }
    .pr-badge-coleccion {
        display:inline-flex; align-items:center; gap:4px;
        padding:3px 9px; background:#fff7e6; color:#b45309;
        border:1px solid #fcd34d; border-radius:20px;
        font-size:11px; font-weight:600;
    }

<<<<<<< HEAD
=======
=======
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    .pr-empty { padding:56px 20px; text-align:center; }
    .pr-empty-icon {
        width:52px; height:52px; background:#fdf0f0; border-radius:50%;
        margin:0 auto 14px; display:flex; align-items:center; justify-content:center;
    }

    .pr-footer {
        padding:14px 16px; border-top:0.5px solid #f5eaea;
        display:flex; justify-content:space-between; align-items:center;
    }
    .pr-count { font-size:12px; color:#aaa; }
    .pr-footer .pagination { margin:0; }
    .pr-footer .page-link {
        border-radius:8px !important; border-color:#f0e0e2;
        color:#888; font-size:12px; padding:5px 12px;
    }
    .pr-footer .page-item.active .page-link { background:var(--ink); border-color:var(--ink); color:#fff; }

<<<<<<< HEAD
    /* Modal */
=======
<<<<<<< HEAD
    /* Modal */
=======
    /* Modal eliminar */
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
    .pr-modal .modal-content { border:none; border-radius:16px; overflow:hidden; }
    .pr-modal .modal-header { background:#fff; border-bottom:0.5px solid #f5eaea; padding:18px 20px; }
    .pr-modal .modal-title { font-size:15px; font-weight:600; color:var(--ink); }
    .pr-modal .modal-body { padding:20px; }
    .pr-modal .modal-footer { border-top:0.5px solid #f5eaea; padding:14px 20px; }
    .pr-modal-warn {
        display:flex; align-items:center; gap:12px;
        padding:14px 16px; background:#fef2f2;
        border:1px solid #fecaca; border-radius:10px;
        font-size:13px; color:#991b1b;
    }
    .pr-modal-icon { width:36px; height:36px; border-radius:50%; background:#fee2e2; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .pr-modal-cancel {
        padding:9px 18px; background:transparent; color:#888;
        border:0.5px solid #ddd; border-radius:8px; font-size:13px; cursor:pointer; font-family:inherit;
    }
    .pr-modal-confirm {
        padding:9px 20px; background:#dc2626; color:#fff;
        border:none; border-radius:8px; font-size:13px; font-weight:500; cursor:pointer; font-family:inherit;
    }
    .pr-modal-confirm:hover { opacity:0.85; }
</style>
@endpush

@section('contenido')
<div class="app-content">
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="pr-header">
            <div>
                <h1 class="pr-title">Productos</h1>
                <p class="pr-subtitle">Gestión del catálogo de calzado</p>
            </div>
            @can('producto-create')
                <a href="{{ route('productos.create') }}" class="pr-btn-new">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Nuevo producto
                </a>
            @endcan
        </div>

        {{-- TOOLBAR --}}
        <form action="{{ route('productos.index') }}" method="GET">
            <div class="pr-toolbar">
                <div class="pr-search-wrap">
                    <svg class="pr-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input class="pr-search-input" type="text" name="texto"
                           placeholder="Buscar por nombre o código..." value="{{ $texto }}">
                </div>
                <button type="submit" class="pr-search-btn">Buscar</button>
            </div>
        </form>

        {{-- ALERTA --}}
        @if(Session::has('mensaje'))
            <div class="pr-alert">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                {{ Session::get('mensaje') }}
            </div>
        @endif

        {{-- TABLA --}}
        <div class="pr-table-card">
            <table class="pr-table">
                <thead>
                    <tr>
                        <th>Opciones</th>
<<<<<<< HEAD
                        <th>Colección</th>
=======
<<<<<<< HEAD
                        <th>Colección</th>
=======
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
                        <th>#ID</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($registros) <= 0)
                        <tr>
<<<<<<< HEAD
                            <td colspan="7">
=======
<<<<<<< HEAD
                            <td colspan="7">
=======
                            <td colspan="6">
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
                                <div class="pr-empty">
                                    <div class="pr-empty-icon">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="1.5">
                                            <rect x="2" y="7" width="20" height="14" rx="2"/>
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                                        </svg>
                                    </div>
                                    <p style="font-size:14px;font-weight:600;color:var(--ink);margin-bottom:4px;">Sin productos</p>
                                    <p style="font-size:12px;color:#999;">No hay registros que coincidan con la búsqueda</p>
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach($registros as $reg)
                            <tr>
<<<<<<< HEAD
                                {{-- Acciones --}}
=======
<<<<<<< HEAD
                                {{-- Acciones --}}
=======
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
                                <td>
                                    @can('producto-edit')
                                        <a href="{{ route('productos.edit', $reg->id) }}" class="pr-btn-edit">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                            </svg>
                                            Editar
                                        </a>
                                    @endcan
                                    @can('producto-delete')
                                        <button class="pr-btn-delete" data-bs-toggle="modal"
                                                data-bs-target="#modal-eliminar-{{ $reg->id }}">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"/>
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                <path d="M10 11v6M14 11v6"/>
                                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                            </svg>
                                            Eliminar
                                        </button>
                                    @endcan
                                </td>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661

                                {{-- Toggle colección --}}
                                <td>
                                    @can('producto-edit')
                                        @if($reg->imagen)
                                            <form action="{{ route('productos.coleccion', $reg->id) }}" method="POST" style="display:inline;">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="pr-btn-coleccion {{ $reg->en_coleccion ? 'activo' : '' }}"
                                                        title="{{ $reg->en_coleccion ? 'Quitar del home' : 'Mostrar en el home' }}">
                                                    <svg width="13" height="13" viewBox="0 0 24 24"
                                                         fill="{{ $reg->en_coleccion ? '#b45309' : 'none' }}"
                                                         stroke="{{ $reg->en_coleccion ? '#b45309' : 'currentColor' }}"
                                                         stroke-width="2">
                                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                                    </svg>
                                                    {{ $reg->en_coleccion ? 'En home' : 'Añadir' }}
                                                </button>
                                            </form>
                                        @else
                                            <span style="font-size:11px;color:#ccc;" title="Sube una imagen para activar esta opción">Sin imagen</span>
                                        @endif
                                    @else
                                        @if($reg->en_coleccion)
                                            <span class="pr-badge-coleccion">
                                                <svg width="11" height="11" viewBox="0 0 24 24" fill="#b45309" stroke="#b45309" stroke-width="2">
                                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                                </svg>
                                                En home
                                            </span>
                                        @endif
                                    @endcan
                                </td>

<<<<<<< HEAD
=======
=======
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
>>>>>>> 1a6a8ea3e00212ff626f4e9306d3ae76237ed661
                                <td style="font-weight:500; color:#888;">#{{ $reg->id }}</td>
                                <td><span class="pr-code">{{ $reg->codigo }}</span></td>
                                <td style="font-weight:500;">{{ $reg->nombre }}</td>
                                <td class="pr-price">{{ moneda($reg->precio) }}</td>
                                <td>
                                    @if($reg->imagen)
                                        <img src="{{ asset('uploads/productos/' . $reg->imagen) }}"
                                             alt="{{ $reg->nombre }}" class="pr-product-img">
                                    @else
                                        <div class="pr-no-img">👟</div>
                                    @endif
                                </td>
                            </tr>

                            {{-- Modal eliminar --}}
                            @can('producto-delete')
                            <div class="modal fade pr-modal" id="modal-eliminar-{{ $reg->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('productos.destroy', $reg->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminar producto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="pr-modal-warn">
                                                    <div class="pr-modal-icon">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                                                            <line x1="12" y1="9" x2="12" y2="13"/>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p style="font-weight:600;margin:0 0 3px;">¿Eliminar <strong>{{ $reg->nombre }}</strong>?</p>
                                                        <p style="font-size:12px;margin:0;opacity:0.8;">Esta acción no se puede deshacer. Se eliminará también la imagen asociada.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="pr-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="pr-modal-confirm">
                                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:5px;">
                                                        <polyline points="3 6 5 6 21 6"/>
                                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                    </svg>
                                                    Sí, eliminar
                                                </button>
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

            <div class="pr-footer">
                <span class="pr-count">{{ $registros->total() }} productos encontrados</span>
                {{ $registros->appends(['texto' => $texto])->links() }}
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('mnuAlmacen').classList.add('menu-open');
    document.getElementById('itemProducto').classList.add('active');
</script>
@endpush