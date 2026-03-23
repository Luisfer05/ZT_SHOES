@extends('autenticacion.app')
@section('titulo', 'ZT|SHOES — Recuperar contraseña')

@section('contenido')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --rose:       #e8b4b8;
    --rose-light: #f5dde0;
    --rose-dark:  #c47a82;
    --nude:       #f0e6e0;
    --ink:        #1a1212;
    --muted:      #7a6060;
    --white:      #fff;
  }

  body {
    background-image: url('{{ asset("assets/img/fondos/header-bg.png") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    font-family: 'DM Sans', sans-serif;
  }

  .rec-card {
    background: rgba(255, 255, 255, 0.97);
    border-radius: 20px;
    width: 360px;
    padding: 32px 28px 36px;
    box-shadow: 0 16px 48px rgba(196, 122, 130, 0.18);
    animation: ztFadeUp 0.55s ease both;
  }

  @keyframes ztFadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .rec-header { text-align: center; margin-bottom: 24px; }

  .rec-logo {
    font-family: 'Cormorant Garamond', serif;
    font-size: 26px;
    font-weight: 600;
    letter-spacing: 0.08em;
    color: var(--ink);
    text-decoration: none;
    display: inline-block;
    margin-bottom: 8px;
  }
  .rec-logo span { color: var(--rose-dark); }

  .rec-eyebrow {
    font-size: 10px;
    font-weight: 500;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--rose-dark);
    margin-bottom: 4px;
  }

  .rec-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px;
    font-weight: 300;
    color: var(--ink);
    line-height: 1.1;
  }

  .rec-subtitle {
    font-size: 0.85rem;
    color: var(--muted);
    margin-top: 8px;
    line-height: 1.5;
  }

  .rec-divider {
    border: none;
    border-top: 0.5px solid #f0e0e2;
    margin: 0 0 22px;
  }

  .input-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fdf8f8;
    border: 1.5px solid #f0dde0;
    border-radius: 12px;
    height: 48px;
    padding: 0 14px;
    margin-bottom: 14px;
    transition: border-color 0.2s;
  }

  .input-wrapper:focus-within { border-color: var(--rose); }

  .input-wrapper.is-invalid {
    border-color: #dc3545;
    background: #fff8f8;
  }

  .input-icon {
    font-size: 1.1rem;
    color: var(--rose-dark);
    flex: 0 0 auto;
    pointer-events: none;
  }

  .input-wrapper input {
    background: transparent;
    border: none;
    outline: none;
    color: var(--ink);
    font-size: 0.95rem;
    font-family: 'DM Sans', sans-serif;
    height: 100%;
    width: 100%;
    padding: 0;
  }

  .input-wrapper input::placeholder {
    color: var(--muted);
    font-weight: 300;
  }

  input:-webkit-autofill,
  input:-webkit-autofill:hover,
  input:-webkit-autofill:focus {
    -webkit-text-fill-color: var(--ink) !important;
    -webkit-box-shadow: 0 0 0px 1000px #fdf8f8 inset !important;
    box-shadow: 0 0 0px 1000px #fdf8f8 inset !important;
  }

  .field-error {
    font-size: 0.8rem;
    color: #dc3545;
    margin: -10px 0 12px 4px;
  }

  .alert-danger {
    background: #fff0f0;
    border: 1px solid #f5c6cb;
    color: #842029;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.87rem;
    margin-bottom: 16px;
  }

  .alert-success {
    background: #f0faf4;
    border: 1px solid #b8dfc9;
    color: #1a5c38;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.87rem;
    margin-bottom: 16px;
    display: flex;
    align-items: flex-start;
    gap: 8px;
  }

  .alert-success i { color: #2d9e60; margin-top: 1px; }

  .btn-send {
    width: 100%;
    padding: 13px;
    background: var(--ink);
    color: var(--white);
    border: none;
    border-radius: 30px;
    font-size: 0.95rem;
    font-weight: 500;
    font-family: 'DM Sans', sans-serif;
    letter-spacing: 0.06em;
    cursor: pointer;
    margin-top: 4px;
    transition: opacity 0.2s;
  }

  .btn-send:hover { opacity: 0.82; }

  .rec-footer {
    text-align: center;
    margin-top: 18px;
    font-size: 0.87rem;
    color: var(--muted);
  }

  .rec-footer a {
    color: var(--rose-dark);
    text-decoration: none;
    font-weight: 500;
  }

  .rec-footer a:hover { text-decoration: underline; }
</style>

<div class="rec-card">

  <div class="rec-header">
    <a href="/" class="rec-logo">ZT<span>|</span>SHOES</a>
    <p class="rec-eyebrow">acceso</p>
    <h1 class="rec-title">Recuperar contraseña</h1>
    <p class="rec-subtitle">Te enviaremos un enlace para restablecer tu contraseña.</p>
  </div>

  <hr class="rec-divider">

  @if(session('error'))
    <div class="alert-danger">{{ session('error') }}</div>
  @endif

  @if(Session::has('mensaje'))
    <div class="alert-success">
      <i class="bi bi-check-circle-fill"></i>
      {{ Session::get('mensaje') }}
    </div>
  @endif

  <form action="{{ route('password.send-link') }}" method="post" novalidate>
    @csrf

    <div class="input-wrapper {{ $errors->has('email') ? 'is-invalid' : '' }}">
      <i class="bi bi-envelope-fill input-icon"></i>
      <input
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="Correo electrónico"
        autocomplete="email"
        required
      >
    </div>
    @error('email')
      <p class="field-error">{{ $message }}</p>
    @enderror

    <button type="submit" class="btn-send">Enviar enlace</button>
  </form>

  <div class="rec-footer">
    <a href="{{ route('login') }}">← Volver al login</a>
  </div>

</div>

@endsection