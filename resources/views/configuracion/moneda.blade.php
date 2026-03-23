@extends('plantilla.app')

@push('estilos')
<style>
    :root {
        --rose:      #e8b4b8;
        --rose-light:#f5dde0;
        --rose-dark: #c47a82;
        --ink:       #1a1212;
        --muted:     #7a6060;
    }

    .cfg-wrap { padding: 28px 32px; max-width: 860px; }

    .cfg-header { margin-bottom: 28px; }
    .cfg-eyebrow {
        font-size: 11px; font-weight: 500; letter-spacing: 0.18em;
        text-transform: uppercase; color: var(--rose-dark); margin-bottom: 6px;
    }
    .cfg-title { font-size: 22px; font-weight: 600; color: var(--ink); margin-bottom: 4px; }
    .cfg-sub   { font-size: 13px; color: var(--muted); }

    /* Card */
    .cfg-card {
        background: #fff; border-radius: 16px;
        border: 0.5px solid #f0e0e2; overflow: hidden;
    }
    .cfg-card-header {
        padding: 16px 24px; border-bottom: 0.5px solid #f0e0e2;
        display: flex; align-items: center; gap: 10px;
    }
    .cfg-card-header h2 { font-size: 14px; font-weight: 600; color: var(--ink); margin: 0; }
    .cfg-card-body { padding: 24px; }

    /* Form grid */
    .cfg-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .cfg-grid-full { grid-column: 1 / -1; }

    .cfg-field { display: flex; flex-direction: column; gap: 6px; }
    .cfg-label { font-size: 12px; font-weight: 500; color: var(--ink); }
    .cfg-hint  { font-size: 11px; color: var(--muted); margin-top: 2px; }

    .cfg-input {
        height: 44px; padding: 0 14px;
        border: 1.5px solid #f0dde0; border-radius: 10px;
        font-size: 14px; font-family: 'DM Sans', sans-serif;
        color: var(--ink); background: #fdf8f8; outline: none;
        transition: border-color 0.2s;
    }
    .cfg-input:focus { border-color: var(--rose); }
    .cfg-input.is-invalid { border-color: #dc3545; }

    .cfg-select {
        height: 44px; padding: 0 36px 0 14px;
        border: 1.5px solid #f0dde0; border-radius: 10px;
        font-size: 14px; font-family: 'DM Sans', sans-serif;
        color: var(--ink); background: #fdf8f8; outline: none;
        transition: border-color 0.2s; appearance: none; width: 100%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23b08888' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 14px center;
        cursor: pointer;
    }
    .cfg-select:focus { border-color: var(--rose); }

    .field-error { font-size: 11px; color: #dc3545; margin-top: 2px; }

    /* Divider */
    .cfg-divider { border: none; border-top: 0.5px solid #f0e0e2; margin: 24px 0; }

    /* Preview */
    .cfg-preview {
        background: var(--rose-light); border-radius: 12px;
        padding: 16px 20px; display: flex; align-items: center;
        justify-content: space-between; flex-wrap: wrap; gap: 12px;
    }
    .cfg-preview-label { font-size: 12px; color: var(--muted); }
    .cfg-preview-value {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px; font-weight: 600; color: var(--ink);
    }
    .cfg-preview-detail { font-size: 12px; color: var(--muted); margin-top: 2px; }

    /* Botón */
    .cfg-btn {
        padding: 12px 32px; background: var(--ink); color: #fff;
        border: none; border-radius: 30px; font-size: 13px; font-weight: 500;
        font-family: 'DM Sans', sans-serif; letter-spacing: 0.05em;
        cursor: pointer; transition: opacity 0.2s;
    }
    .cfg-btn:hover { opacity: 0.82; }

    /* Alert */
    .cfg-alert-success {
        background: #f0faf4; border: 1px solid #b8dfc9; color: #1a5c38;
        border-radius: 10px; padding: 12px 16px; font-size: 13px;
        margin-bottom: 20px; display: flex; align-items: center; gap: 8px;
    }

    /* Monedas presets */
    .preset-grid { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
    .preset-btn {
        padding: 7px 16px; background: #fdf8f8;
        border: 1.5px solid #f0dde0; border-radius: 20px;
        font-size: 12px; font-weight: 500; color: var(--muted);
        cursor: pointer; transition: all 0.15s; font-family: 'DM Sans', sans-serif;
    }
    .preset-btn:hover { background: var(--rose-light); border-color: var(--rose); color: var(--ink); }
    .preset-btn.active { background: var(--ink); border-color: var(--ink); color: #fff; }

    @media (max-width: 640px) {
        .cfg-grid { grid-template-columns: 1fr; }
        .cfg-wrap { padding: 16px; }
    }
</style>
@endpush

@section('contenido')
<div class="app-content">
<div class="cfg-wrap">

    <div class="cfg-header">
        <p class="cfg-eyebrow">Panel admin</p>
        <h1 class="cfg-title">Configuración de moneda</h1>
        <p class="cfg-sub">Define el símbolo, nombre y tasa de conversión que se mostrará en toda la tienda.</p>
    </div>

    @if(session('mensaje'))
        <div class="cfg-alert-success">
            <i class="bi bi-check-circle-fill"></i> {{ session('mensaje') }}
        </div>
    @endif

    <form action="{{ route('configuracion.moneda.update') }}" method="POST" id="cfgForm">
        @csrf
        @method('PUT')

        <div class="cfg-card" style="margin-bottom: 20px;">
            <div class="cfg-card-header">
                <i class="bi bi-lightning-charge-fill" style="color:var(--rose-dark)"></i>
                <h2>Presets rápidos</h2>
            </div>
            <div class="cfg-card-body">
                <div class="preset-grid">
                    @php
                        $presets = [
                            ['label'=>'🇺🇸 USD', 'simbolo'=>'$',   'nombre'=>'USD', 'tasa'=>1,        'dec'=>'.', 'mil'=>','],
                            ['label'=>'🇨🇴 COP', 'simbolo'=>'$',   'nombre'=>'COP', 'tasa'=>4200,     'dec'=>',', 'mil'=>'.'],
                            ['label'=>'🇪🇺 EUR', 'simbolo'=>'€',   'nombre'=>'EUR', 'tasa'=>0.93,     'dec'=>',', 'mil'=>'.'],
                            ['label'=>'🇬🇧 GBP', 'simbolo'=>'£',   'nombre'=>'GBP', 'tasa'=>0.79,     'dec'=>'.', 'mil'=>','],
                            ['label'=>'🇲🇽 MXN', 'simbolo'=>'$',   'nombre'=>'MXN', 'tasa'=>17.2,     'dec'=>'.', 'mil'=>','],
                            ['label'=>'🇧🇷 BRL', 'simbolo'=>'R$',  'nombre'=>'BRL', 'tasa'=>5.0,      'dec'=>',', 'mil'=>'.'],
                            ['label'=>'🇨🇱 CLP', 'simbolo'=>'$',   'nombre'=>'CLP', 'tasa'=>950,      'dec'=>',', 'mil'=>'.'],
                            ['label'=>'🇵🇪 PEN', 'simbolo'=>'S/',  'nombre'=>'PEN', 'tasa'=>3.75,     'dec'=>'.', 'mil'=>','],
                        ];
                        $actual = $config['moneda_nombre'] ?? 'USD';
                    @endphp

                    @foreach($presets as $p)
                        <button type="button" class="preset-btn {{ $actual === $p['nombre'] ? 'active' : '' }}"
                            data-simbolo="{{ $p['simbolo'] }}"
                            data-nombre="{{ $p['nombre'] }}"
                            data-tasa="{{ $p['tasa'] }}"
                            data-decimal="{{ $p['dec'] }}"
                            data-miles="{{ $p['mil'] }}">
                            {{ $p['label'] }}
                        </button>
                    @endforeach
                </div>
                <p style="font-size:12px; color:var(--muted);">
                    <i class="bi bi-info-circle"></i>
                    Selecciona un preset para rellenar automáticamente los campos, o edítalos manualmente.
                    Las tasas son aproximadas — puedes ajustarlas.
                </p>
            </div>
        </div>

        <div class="cfg-card" style="margin-bottom: 20px;">
            <div class="cfg-card-header">
                <i class="bi bi-currency-exchange" style="color:var(--rose-dark)"></i>
                <h2>Configuración manual</h2>
            </div>
            <div class="cfg-card-body">
                <div class="cfg-grid">

                    {{-- Símbolo --}}
                    <div class="cfg-field">
                        <label class="cfg-label" for="moneda_simbolo">Símbolo</label>
                        <input id="moneda_simbolo" name="moneda_simbolo" type="text"
                            class="cfg-input @error('moneda_simbolo') is-invalid @enderror"
                            value="{{ old('moneda_simbolo', $config['moneda_simbolo'] ?? '$') }}"
                            placeholder="$, €, £, S/, R$...">
                        <span class="cfg-hint">Carácter que aparece antes del precio</span>
                        @error('moneda_simbolo')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    {{-- Nombre --}}
                    <div class="cfg-field">
                        <label class="cfg-label" for="moneda_nombre">Código ISO</label>
                        <input id="moneda_nombre" name="moneda_nombre" type="text"
                            class="cfg-input @error('moneda_nombre') is-invalid @enderror"
                            value="{{ old('moneda_nombre', $config['moneda_nombre'] ?? 'USD') }}"
                            placeholder="USD, COP, EUR..."
                            maxlength="10">
                        <span class="cfg-hint">Código de 3 letras de la moneda</span>
                        @error('moneda_nombre')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    {{-- Tasa --}}
                    <div class="cfg-field">
                        <label class="cfg-label" for="moneda_tasa">Tasa de cambio</label>
                        <input id="moneda_tasa" name="moneda_tasa" type="number"
                            class="cfg-input @error('moneda_tasa') is-invalid @enderror"
                            value="{{ old('moneda_tasa', $config['moneda_tasa'] ?? '1') }}"
                            step="0.0001" min="0.0001"
                            placeholder="1.00">
                        <span class="cfg-hint">Multiplicador aplicado al precio base (USD)</span>
                        @error('moneda_tasa')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    {{-- Separador decimal --}}
                    <div class="cfg-field">
                        <label class="cfg-label" for="moneda_decimal">Separador decimal</label>
                        <select id="moneda_decimal" name="moneda_decimal" class="cfg-select">
                            <option value="." {{ ($config['moneda_decimal'] ?? '.') === '.' ? 'selected' : '' }}>Punto ( . ) — 1,234.56</option>
                            <option value="," {{ ($config['moneda_decimal'] ?? '.') === ',' ? 'selected' : '' }}>Coma ( , ) — 1.234,56</option>
                        </select>
                        <span class="cfg-hint">Carácter para separar decimales</span>
                    </div>

                    {{-- Separador de miles --}}
                    <div class="cfg-field">
                        <label class="cfg-label" for="moneda_miles">Separador de miles</label>
                        <select id="moneda_miles" name="moneda_miles" class="cfg-select">
                            <option value="," {{ ($config['moneda_miles'] ?? ',') === ',' ? 'selected' : '' }}>Coma ( , ) — 1,234.56</option>
                            <option value="." {{ ($config['moneda_miles'] ?? ',') === '.' ? 'selected' : '' }}>Punto ( . ) — 1.234,56</option>
                            <option value=" " {{ ($config['moneda_miles'] ?? ',') === ' ' ? 'selected' : '' }}>Espacio — 1 234,56</option>
                        </select>
                        <span class="cfg-hint">Carácter para agrupar miles</span>
                    </div>

                </div>

                <hr class="cfg-divider">

                {{-- Preview en vivo --}}
                <div class="cfg-preview" style="margin-bottom: 20px;">
                    <div>
                        <div class="cfg-preview-label">Vista previa del precio</div>
                        <div class="cfg-preview-value" id="previewPrecio">$49.99</div>
                        <div class="cfg-preview-detail" id="previewDetalle">USD · tasa ×1</div>
                    </div>
                    <div style="text-align:right;">
                        <div class="cfg-preview-label">Precio base (ejemplo)</div>
                        <div style="font-size:14px; color:var(--muted);">$49.99 USD</div>
                    </div>
                </div>

                <button type="submit" class="cfg-btn">
                    <i class="bi bi-check2 me-2"></i>Guardar configuración
                </button>
            </div>
        </div>

    </form>

</div>
</div>
@endsection

@push('scripts')
<script>
// ── Presets ──
document.querySelectorAll('.preset-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('moneda_simbolo').value = btn.dataset.simbolo;
        document.getElementById('moneda_nombre').value  = btn.dataset.nombre;
        document.getElementById('moneda_tasa').value    = btn.dataset.tasa;
        document.getElementById('moneda_decimal').value = btn.dataset.decimal;
        document.getElementById('moneda_miles').value   = btn.dataset.miles;

        document.querySelectorAll('.preset-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        actualizarPreview();
    });
});

// ── Preview en vivo ──
function actualizarPreview() {
    const simbolo  = document.getElementById('moneda_simbolo').value || '$';
    const nombre   = document.getElementById('moneda_nombre').value  || 'USD';
    const tasa     = parseFloat(document.getElementById('moneda_tasa').value) || 1;
    const decimal  = document.getElementById('moneda_decimal').value || '.';
    const miles    = document.getElementById('moneda_miles').value   || ',';

    const base  = 49.99;
    const valor = base * tasa;

    // Formatear manualmente
    const partes   = valor.toFixed(2).split('.');
    const entero   = partes[0].replace(/\B(?=(\d{3})+(?!\d))/g, miles);
    const formateado = simbolo + entero + decimal + partes[1];

    document.getElementById('previewPrecio').textContent  = formateado;
    document.getElementById('previewDetalle').textContent = nombre + ' · tasa ×' + tasa;
}

['moneda_simbolo','moneda_nombre','moneda_tasa','moneda_decimal','moneda_miles'].forEach(id => {
    document.getElementById(id)?.addEventListener('input', actualizarPreview);
    document.getElementById(id)?.addEventListener('change', actualizarPreview);
});

actualizarPreview();
</script>
@endpush