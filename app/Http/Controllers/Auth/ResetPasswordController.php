<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recuperar contraseña – ZT|SHOES</title>
</head>
<body style="margin:0;padding:0;background:#f9f4f4;font-family:'DM Sans',Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f9f4f4;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="480" cellpadding="0" cellspacing="0"
               style="background:#ffffff;border-radius:16px;overflow:hidden;
                      box-shadow:0 8px 32px rgba(196,122,130,0.12);">

          {{-- Header --}}
          <tr>
            <td align="center" style="background:#1a1212;padding:28px 32px;">
              <span style="font-family:Georgia,serif;font-size:26px;
                           font-weight:600;letter-spacing:0.1em;color:#ffffff;">
                ZT<span style="color:#e8b4b8;">|</span>SHOES
              </span>
            </td>
          </tr>

          {{-- Body --}}
          <tr>
            <td style="padding:36px 40px 28px;">
              <p style="margin:0 0 6px;font-size:11px;font-weight:600;
                        letter-spacing:0.2em;text-transform:uppercase;color:#c47a82;">
                Seguridad
              </p>
              <h1 style="margin:0 0 16px;font-family:Georgia,serif;font-size:26px;
                         font-weight:300;color:#1a1212;line-height:1.2;">
                Recupera tu contraseña
              </h1>
              <p style="margin:0 0 24px;font-size:0.9rem;color:#7a6060;line-height:1.6;">
                Recibimos una solicitud para restablecer la contraseña de tu cuenta.
                Haz clic en el botón de abajo para elegir una nueva.
                El enlace es válido por <strong>60 minutos</strong>.
              </p>

              <table cellpadding="0" cellspacing="0" style="margin:0 auto 28px;">
                <tr>
                  <td align="center" style="background:#1a1212;border-radius:30px;">
                    <a href="{{ url('/password/reset/' . $token) }}"
                       style="display:inline-block;padding:13px 36px;
                              color:#ffffff;text-decoration:none;
                              font-size:0.95rem;font-weight:500;
                              letter-spacing:0.06em;">
                      Restablecer contraseña
                    </a>
                  </td>
                </tr>
              </table>

              <p style="margin:0 0 8px;font-size:0.82rem;color:#a08a8a;line-height:1.6;">
                Si el botón no funciona, copia y pega este enlace en tu navegador:
              </p>
              <p style="margin:0 0 24px;word-break:break-all;font-size:0.8rem;color:#c47a82;">
                {{ url('/password/reset/' . $token) }}
              </p>

              <hr style="border:none;border-top:1px solid #f0e0e2;margin:0 0 20px;">

              <p style="margin:0;font-size:0.8rem;color:#b0a0a0;line-height:1.5;">
                Si no solicitaste esto, puedes ignorar este correo.
                Tu contraseña seguirá siendo la misma.
              </p>
            </td>
          </tr>

          {{-- Footer --}}
          <tr>
            <td align="center"
                style="background:#fdf8f8;padding:18px 32px;
                       font-size:0.78rem;color:#b0a0a0;border-top:1px solid #f0e0e2;">
              © {{ date('Y') }} ZT|SHOES · Este es un correo automático, no respondas.
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>