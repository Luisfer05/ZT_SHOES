<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pedido Confirmado</title>
<style>
  body { margin:0; padding:0; background:#fdf8f8; font-family:'Helvetica Neue',Arial,sans-serif; color:#1a1212; }
  .wrap { max-width:600px; margin:0 auto; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 20px rgba(0,0,0,.06); }
  .header { background:#1a1212; padding:36px 40px; text-align:center; }
  .header h1 { color:#fff; font-size:22px; font-weight:300; letter-spacing:0.15em; margin:0; }
  .header p  { color:#e8b4b8; font-size:12px; letter-spacing:0.25em; text-transform:uppercase; margin:8px 0 0; }
  .body { padding:36px 40px; }
  .greeting { font-size:18px; font-weight:600; margin-bottom:8px; }
  .subtext  { font-size:14px; color:#7a6060; margin-bottom:28px; line-height:1.6; }
  .badge { display:inline-block; background:#fef3c7; color:#92400e; border-radius:20px; padding:5px 14px; font-size:12px; font-weight:600; margin-bottom:28px; }
  /* Dirección */
  .section-title { font-size:11px; font-weight:600; letter-spacing:0.12em; text-transform:uppercase; color:#c47a82; margin-bottom:12px; }
  .address-box { background:#fdf8f8; border:0.5px solid #f0e0e2; border-radius:10px; padding:16px 18px; margin-bottom:24px; font-size:13px; color:#1a1212; line-height:1.7; }
  /* Tabla productos */
  .prod-table { width:100%; border-collapse:collapse; margin-bottom:24px; }
  .prod-table th { font-size:11px; font-weight:600; color:#999; text-transform:uppercase; letter-spacing:0.08em; padding:8px 0; border-bottom:1px solid #f0e0e2; text-align:left; }
  .prod-table td { font-size:13px; padding:12px 0; border-bottom:0.5px solid #fdf0f1; vertical-align:middle; }
  .prod-table tr:last-child td { border-bottom:none; }
  .prod-name { font-weight:500; color:#1a1212; }
  .prod-qty  { color:#7a6060; }
  .prod-price { font-weight:600; text-align:right; }
  /* Totales */
  .totals { background:#fdf8f8; border-radius:10px; padding:16px 18px; margin-bottom:28px; }
  .total-row { display:flex; justify-content:space-between; font-size:13px; color:#7a6060; margin-bottom:8px; }
  .total-row:last-child { margin-bottom:0; border-top:1px solid #f0e0e2; padding-top:10px; margin-top:6px; font-size:16px; font-weight:700; color:#1a1212; }
  /* CTA */
  .cta { text-align:center; margin-bottom:28px; }
  .cta a { display:inline-block; background:#1a1212; color:#fff; text-decoration:none; padding:14px 32px; border-radius:30px; font-size:13px; font-weight:500; letter-spacing:0.05em; }
  /* Footer */
  .footer { background:#fdf8f8; padding:24px 40px; text-align:center; font-size:11px; color:#aaa; border-top:0.5px solid #f0e0e2; }
</style>
</head>
<body>
<div style="padding:32px 16px;">
<div class="wrap">

  <div class="header">
    <h1>ZT | SHOES</h1>
    <p>Confirmación de pedido</p>
  </div>

  <div class="body">
    <div class="greeting">¡Hola, {{ $pedido->user->name }}! 🎉</div>
    <p class="subtext">
      Tu pedido fue recibido correctamente. Lo prepararemos pronto y te notificaremos cada vez que cambie de estado.
    </p>

    <span class="badge">Pedido #{{ $pedido->id }} · {{ ucfirst($pedido->estado) }}</span>

    {{-- Dirección de envío --}}
    @if($pedido->direccion)
    <div class="section-title">Dirección de envío</div>
    <div class="address-box">
      📍 {{ $pedido->direccion }}, {{ $pedido->ciudad }}<br>
      @if($pedido->telefono) 📞 {{ $pedido->telefono }}<br> @endif
      @if($pedido->notas) 📝 {{ $pedido->notas }} @endif
    </div>
    @endif

    {{-- Productos --}}
    <div class="section-title">Productos</div>
    <table class="prod-table">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cant.</th>
          <th style="text-align:right;">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pedido->detalles as $d)
        <tr>
          <td class="prod-name">{{ $d->producto->nombre ?? 'Producto' }}</td>
          <td class="prod-qty">× {{ $d->cantidad }}</td>
          <td class="prod-price">{{ moneda($d->precio * $d->cantidad) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{-- Totales --}}
    @php
      $subtotal = $pedido->detalles->sum(fn($d) => $d->precio * $d->cantidad);
      $envio    = $pedido->total - $subtotal;
    @endphp
    <div class="totals">
      <div class="total-row"><span>Subtotal</span><span>{{ moneda($subtotal) }}</span></div>
      <div class="total-row">
        <span>Envío</span>
        <span>{{ $envio <= 0 ? 'Gratis' : moneda($envio) }}</span>
      </div>
      <div class="total-row"><span>Total</span><span>{{ moneda($pedido->total) }}</span></div>
    </div>

    <div class="cta">
      <a href="{{ route('perfil.pedidos') }}">Ver mis pedidos →</a>
    </div>
  </div>

  <div class="footer">
    © {{ date('Y') }} ZT|SHOES · Este correo fue enviado a {{ $pedido->user->email }}
  </div>

</div>
</div>
</body>
</html>
