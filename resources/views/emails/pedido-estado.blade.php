<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Estado de tu pedido</title>
<style>
  body { margin:0; padding:0; background:#fdf8f8; font-family:'Helvetica Neue',Arial,sans-serif; color:#1a1212; }
  .wrap { max-width:600px; margin:0 auto; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 20px rgba(0,0,0,.06); }
  .header { background:#1a1212; padding:36px 40px; text-align:center; }
  .header h1 { color:#fff; font-size:22px; font-weight:300; letter-spacing:0.15em; margin:0; }
  .header p  { color:#e8b4b8; font-size:12px; letter-spacing:0.25em; text-transform:uppercase; margin:8px 0 0; }
  .body { padding:36px 40px; }
  .greeting { font-size:18px; font-weight:600; margin-bottom:8px; }
  .subtext  { font-size:14px; color:#7a6060; margin-bottom:28px; line-height:1.6; }
  /* Timeline visual */
  .timeline { display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:32px; }
  .tl-step  { flex:1; text-align:center; }
  .tl-dot   { width:36px; height:36px; border-radius:50%; margin:0 auto 8px; display:flex; align-items:center; justify-content:center; font-size:15px; border:2px solid #f0dde0; background:#fff; }
  .tl-dot.done   { background:#1a1212; border-color:#1a1212; color:#fff; }
  .tl-dot.active { background:#c47a82; border-color:#c47a82; color:#fff; box-shadow:0 0 0 4px rgba(196,122,130,0.2); }
  .tl-dot.pending{ background:#fdf8f8; color:#ccc; }
  .tl-dot.cancelled{ background:#fff0f0; border-color:#fca5a5; color:#ef4444; }
  .tl-label { font-size:11px; font-weight:500; color:#aaa; }
  .tl-label.done   { color:#1a1212; }
  .tl-label.active { color:#c47a82; font-weight:700; }
  .tl-line { flex:1; height:2px; background:#f0dde0; margin-top:17px; }
  .tl-line.done { background:#1a1212; }
  /* Info box */
  .info-box { border-left:3px solid #c47a82; background:#fdf8f8; border-radius:0 10px 10px 0; padding:14px 18px; margin-bottom:24px; font-size:13px; line-height:1.7; color:#1a1212; }
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
    <p>Actualización de tu pedido</p>
  </div>

  <div class="body">
    <div class="greeting">Hola, {{ $pedido->user->name }} 👋</div>
    <p class="subtext">
      Tu pedido <strong>#{{ $pedido->id }}</strong> ha cambiado de estado
      de <em>{{ ucfirst($estadoAnterior) }}</em> a <strong>{{ ucfirst($pedido->estado) }}</strong>.
    </p>

    {{-- Timeline --}}
    @php
      $pasos = ['pendiente','procesando','enviado','entregado'];
      $cancelado = in_array($pedido->estado, ['anulado','cancelado']);
      $idxActual = array_search($pedido->estado, $pasos);
      $iconos = ['pendiente'=>'🕐','procesando'=>'📦','enviado'=>'🚚','entregado'=>'✅'];
    @endphp

    @if($cancelado)
      <div class="info-box">
        ❌ Este pedido fue <strong>{{ $pedido->estado }}</strong>.
        Si tienes dudas, contáctanos respondiendo este correo.
      </div>
    @else
      <div class="timeline">
        @foreach($pasos as $i => $paso)
          @php
            if($idxActual === false) $cls = 'pending';
            elseif($i < $idxActual)  $cls = 'done';
            elseif($i === $idxActual) $cls = 'active';
            else                      $cls = 'pending';
          @endphp
          <div class="tl-step">
            <div class="tl-dot {{ $cls }}">{{ $iconos[$paso] }}</div>
            <div class="tl-label {{ $cls }}">{{ ucfirst($paso) }}</div>
          </div>
          @if(!$loop->last)
            <div class="tl-line {{ $i < $idxActual ? 'done' : '' }}"></div>
          @endif
        @endforeach
      </div>

      @php
        $mensajes = [
          'procesando' => 'Estamos preparando tu pedido. Pronto estará listo para envío.',
          'enviado'    => '¡Tu pedido ya está en camino! El repartidor lo entregará pronto.',
          'entregado'  => '¡Tu pedido fue entregado! Gracias por comprar en ZT|SHOES. 🎉',
        ];
      @endphp
      @if(isset($mensajes[$pedido->estado]))
        <div class="info-box">{{ $mensajes[$pedido->estado] }}</div>
      @endif
    @endif

    <div class="cta">
      <a href="{{ route('perfil.pedidos') }}">Ver seguimiento completo →</a>
    </div>
  </div>

  <div class="footer">
    © {{ date('Y') }} ZT|SHOES · Pedido #{{ $pedido->id }} · {{ $pedido->user->email }}
  </div>

</div>
</div>
</body>
</html>
