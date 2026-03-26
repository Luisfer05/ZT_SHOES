@extends('plantilla.app')

@push('estilos')
<style>
    :root {
        --rose: #e8b4b8; --rose-light: #f5dde0;
        --rose-dark: #c47a82; --nude: #f0e6e0; --ink: #1a1212;
    }
    .pra-wrapper { max-width: 820px; margin: 0 auto; padding: 32px 20px; }

    .pra-header { display:flex; align-items:center; gap:14px; margin-bottom:28px; }
    .pra-back {
        width:36px; height:36px; border-radius:10px;
        background:#fff; border:0.5px solid #f0e0e2;
        display:flex; align-items:center; justify-content:center;
        cursor:pointer; text-decoration:none; color:#888;
        transition:all 0.15s; flex-shrink:0;
    }
    .pra-back:hover { background:var(--nude); color:var(--ink); border-color:var(--rose); }
    .pra-title { font-size:20px; font-weight:600; color:var(--ink); margin:0 0 2px; }
    .pra-subtitle { font-size:13px; color:#aaa; margin:0; }

    .pra-card {
        background:#fff; border:0.5px solid #f0e0e2;
        border-radius:16px; overflow:hidden; margin-bottom:16px;
    }
    .pra-card-header {
        padding:15px 20px; border-bottom:0.5px solid #f5eaea;
        display:flex; align-items:center; gap:10px;
    }
    .pra-card-icon {
        width:32px; height:32px; border-radius:8px;
        background:var(--rose-light); display:flex;
        align-items:center; justify-content:center; flex-shrink:0;
    }
    .pra-card-title { font-size:14px; font-weight:600; color:var(--ink); margin:0; }
    .pra-card-body { padding:20px; }

    .pra-grid-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; }
    .pra-grid-2 { display:grid; grid-template-columns:2fr 1fr; gap:16px; }
    @media(max-width:640px) {
        .pra-grid-3 { grid-template-columns:1fr; }
        .pra-grid-2 { grid-template-columns:1fr; }
    }

    .pra-field { margin-bottom:4px; }
    .pra-label {
        display:block; font-size:12px; font-weight:500; color:#888;
        text-transform:uppercase; letter-spacing:0.06em; margin-bottom:7px;
    }
    .pra-input, .pra-textarea {
        width:100%; padding:11px 14px;
        border:1.5px solid #f0dde0; border-radius:10px;
        font-size:14px; color:var(--ink); background:#fdf8f8;
        outline:none; font-family:inherit; transition:border-color 0.2s, box-shadow 0.2s;
    }
    .pra-input:focus, .pra-textarea:focus {
        border-color:var(--rose);
        box-shadow:0 0 0 3px rgba(232,180,184,0.15);
        background:#fff;
    }
    .pra-input.is-invalid, .pra-textarea.is-invalid { border-color:#fca5a5; }
    .pra-textarea { resize:vertical; min-height:100px; }
    .pra-error { font-size:12px; color:#dc2626; margin-top:5px; display:block; }

    /* Precio con prefijo */
    .pra-input-prefix { position:relative; }
    .pra-prefix {
        position:absolute; left:13px; top:50%; transform:translateY(-50%);
        font-size:14px; color:#bbb; pointer-events:none; font-weight:500;
    }
    .pra-input-prefix .pra-input { padding-left:26px; }

    /* Upload imagen */
    .pra-upload-area {
        border:2px dashed #f0dde0; border-radius:12px;
        padding:24px; text-align:center; cursor:pointer;
        transition:all 0.2s; background:#fdf8f8; position:relative;
    }
    .pra-upload-area:hover { border-color:var(--rose); background:var(--rose-light); }
    .pra-upload-area input[type="file"] {
        position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%;
    }
    .pra-upload-icon { font-size:28px; margin-bottom:8px; }
    .pra-upload-text { font-size:13px; color:#aaa; }
    .pra-upload-text strong { color:var(--rose-dark); }

    .pra-current-img {
        margin-top:14px; display:flex; align-items:center; gap:12px;
        padding:12px 14px; background:#fff; border:0.5px solid #f0e0e2;
        border-radius:10px;
    }
    .pra-current-img img { width:56px; height:56px; object-fit:cover; border-radius:8px; }
    .pra-current-img-info p { font-size:12px; color:#aaa; margin:0; }
    .pra-current-img-info span { font-size:13px; font-weight:500; color:var(--ink); }

    /* Actions */
    .pra-actions {
        display:flex; justify-content:flex-end; gap:10px; margin-top:8px;
    }
    .pra-btn-cancel {
        padding:11px 22px; background:transparent; color:#888;
        border:1.5px solid #e8e0e0; border-radius:10px;
        font-size:13px; font-weight:500; cursor:pointer; font-family:inherit;
        transition:all 0.15s;
    }
    .pra-btn-cancel:hover { background:#f5f0f0; color:var(--ink); }
    .pra-btn-save {
        padding:11px 26px; background:var(--ink); color:#fff;
        border:none; border-radius:10px; font-size:13px; font-weight:500;
        cursor:pointer; font-family:inherit; display:flex; align-items:center;
        gap:7px; transition:opacity 0.2s;
    }
    .pra-btn-save:hover { opacity:0.85; }
</style>
@endpush

@section('contenido')
<div class="app-content">
    <div class="container-fluid">
        <div class="pra-wrapper">

            {{-- HEADER --}}
            <div class="pra-header">
                <a href="{{ route('productos.index') }}" class="pra-back">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </a>
                <div>
                    <h1 class="pra-title">{{ isset($registro) ? 'Editar producto' : 'Nuevo producto' }}</h1>
                    <p class="pra-subtitle">{{ isset($registro) ? 'Modifica los datos de ' . $registro->nombre : 'Agrega un nuevo producto al catálogo' }}</p>
                </div>
            </div>

            <form action="{{ isset($registro) ? route('productos.update', $registro->id) : route('productos.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($registro)) @method('PUT') @endif

                {{-- INFORMACIÓN BÁSICA --}}
                <div class="pra-card">
                    <div class="pra-card-header">
                        <div class="pra-card-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2">
                                <path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/>
                            </svg>
                        </div>
                        <p class="pra-card-title">Información del producto</p>
                    </div>
                    <div class="pra-card-body">
                        <div class="pra-grid-3">
                            <div class="pra-field">
                                <label class="pra-label" for="codigo">Código</label>
                                <input class="pra-input @error('codigo') is-invalid @enderror"
                                       type="text" id="codigo" name="codigo"
                                       value="{{ old('codigo', $registro->codigo ?? '') }}"
                                       placeholder="Ej: ZT-001" required>
                                @error('codigo') <span class="pra-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="pra-field">
                                <label class="pra-label" for="nombre">Nombre</label>
                                <input class="pra-input @error('nombre') is-invalid @enderror"
                                       type="text" id="nombre" name="nombre"
                                       value="{{ old('nombre', $registro->nombre ?? '') }}"
                                       placeholder="Nombre del producto" required>
                                @error('nombre') <span class="pra-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="pra-field">
                                @php $cfg = moneda_config(); @endphp
                                <label class="pra-label" for="precio">Precio ({{ $cfg['nombre'] }})</label>
                                <div class="pra-input-prefix">
                                    <span class="pra-prefix">{{ $cfg['simbolo'] }}</span>
                                    <input class="pra-input @error('precio') is-invalid @enderror"
                                           type="number" id="precio" name="precio" step="0.01" min="0"
                                           value="{{ old('precio', $registro->precio ?? '') }}"
                                           placeholder="0.00" required>
                                </div>
                                @error('precio') <span class="pra-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div style="margin-top:16px;">
                            <label class="pra-label" for="descripcion">Descripción</label>
                            <textarea class="pra-textarea @error('descripcion') is-invalid @enderror"
                                      id="descripcion" name="descripcion"
                                      placeholder="Describe el producto...">{{ old('descripcion', $registro->descripcion ?? '') }}</textarea>
                            @error('descripcion') <span class="pra-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- IMAGEN --}}
                <div class="pra-card">
                    <div class="pra-card-header">
                        <div class="pra-card-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#c47a82" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                        </div>
                        <p class="pra-card-title">Imagen del producto</p>
                    </div>
                    <div class="pra-card-body">
                        <div class="pra-upload-area" id="upload-area">
                            <input type="file" id="imagen" name="imagen"
                                   accept="image/*" onchange="previewImg(this)">
                            <div class="pra-upload-icon">📁</div>
                            <p class="pra-upload-text">
                                <strong>Haz clic para subir</strong> o arrastra la imagen aquí
                            </p>
                            <p style="font-size:11px;color:#ccc;margin-top:4px;">PNG, JPG, WEBP — máx. 2MB</p>
                        </div>
                        @error('imagen') <span class="pra-error" style="margin-top:8px;">{{ $message }}</span> @enderror

                        {{-- Preview nueva imagen --}}
                        <div id="preview-wrap" style="display:none;margin-top:14px;" class="pra-current-img">
                            <img id="preview-img" src="" alt="Preview">
                            <div class="pra-current-img-info">
                                <p>Nueva imagen seleccionada</p>
                                <span id="preview-name"></span>
                            </div>
                        </div>

                        {{-- Imagen actual --}}
                        @if(isset($registro) && $registro->imagen)
                            <div class="pra-current-img" id="current-img-wrap" style="margin-top:14px;">
                                <img src="{{ asset('uploads/productos/' . $registro->imagen) }}"
                                     alt="{{ $registro->nombre }}">
                                <div class="pra-current-img-info">
                                    <p>Imagen actual</p>
                                    <span>{{ $registro->imagen }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- ACCIONES --}}
                <div class="pra-actions">
                    <button type="button" class="pra-btn-cancel"
                            onclick="window.location.href='{{ route('productos.index') }}'">
                        Cancelar
                    </button>
                    <button type="submit" class="pra-btn-save">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        {{ isset($registro) ? 'Guardar cambios' : 'Crear producto' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('mnuAlmacen').classList.add('menu-open');
    document.getElementById('itemProducto').classList.add('active');

    function previewImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('preview-name').textContent = input.files[0].name;
                document.getElementById('preview-wrap').style.display = 'flex';
                var cur = document.getElementById('current-img-wrap');
                if (cur) cur.style.opacity = '0.4';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush