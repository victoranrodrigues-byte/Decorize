<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Entrar ou criar conta — Traço</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/base.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/login.css') }}">
</head>
<body>

<header class="site-header">
  <div class="wrap">
    <a href="{{ url('/') }}" class="brand">
      <span class="brand-mark"><span>T</span></span>
      Traço
    </a>
    <nav class="main-nav"></nav>
    <div class="nav-actions">
      <a href="{{ url('/') }}" class="btn btn-outline-chalk">← Página inicial</a>
    </div>
  </div>
</header>

<main class="auth-shell">
  <section class="auth-side blueprint-surface">
    <div class="auth-side-inner">
      <span class="eyebrow">Acesso ao estúdio</span>
      <h1>Todo projeto<br>começa com<br>uma conta.</h1>
      <p>Guarde seus ambientes, mobílias e modelos em um único lugar —
      e volte a eles de qualquer dispositivo.</p>

      <ul class="auth-legend">
        <li><span class="dot"></span>Projetos ilimitados</li>
        <li><span class="dot"></span>Modelos 2D e 3D</li>
        <li><span class="dot"></span>Acesso via API</li>
      </ul>
    </div>
  </section>

  <section class="auth-form-side">
    <div class="auth-card">
      <div class="tabs" role="tablist">
        <button class="tab is-active" role="tab" aria-selected="true" data-tab="entrar" id="tab-entrar">Entrar</button>
        <button class="tab" role="tab" aria-selected="false" data-tab="cadastro" id="tab-cadastro">Cadastrar</button>
        <span class="tab-indicator"></span>
      </div>

      <form class="auth-form is-active" id="form-entrar" method="POST" action="{{ url('/login') }}">
        @csrf
        <span class="form-code">FORM · 01 / LOGIN</span>

        @if ($errors->any())
            <div class="erro-box">
                @foreach ($errors->all() as $erro)
                    <p>{{ $erro }}</p>
                @endforeach
            </div>
        @endif

        <label class="field">
          <span>E-mail</span>
          <input type="email" name="email" placeholder="voce@exemplo.com" value="{{ old('email') }}" required>
        </label>

        <label class="field">
          <span>Senha</span>
          <input type="password" name="password" placeholder="••••••••" required>
        </label>

        <button type="submit" class="btn btn-signal btn-block">Entrar</button>

        <p class="form-switch">Ainda não tem conta?
          <button type="button" class="link-switch" data-target="cadastro">Cadastre-se</button>
        </p>
      </form>

      <form class="auth-form" id="form-cadastro" method="POST" action="{{ url('/registrar') }}">
        @csrf
        <span class="form-code">FORM · 02 / CADASTRO</span>

        <label class="field">
          <span>Nome</span>
          <input type="text" name="name" placeholder="Seu nome completo" value="{{ old('name') }}" required>
        </label>

        <label class="field">
          <span>E-mail</span>
          <input type="email" name="email" placeholder="voce@exemplo.com" value="{{ old('email') }}" required>
        </label>

        <label class="field">
          <span>Senha</span>
          <input type="password" name="password" placeholder="mínimo de 6 caracteres" minlength="6" required>
        </label>

        <label class="field">
          <span>Confirmar senha</span>
          <input type="password" name="password_confirmation" placeholder="repita a senha" minlength="6" required>
        </label>

        <button type="submit" class="btn btn-signal btn-block">Criar conta</button>

        <p class="form-switch">Já tem conta?
          <button type="button" class="link-switch" data-target="entrar">Entrar</button>
        </p>
      </form>

    </div>
  </section>
</main>

<script>
  const tabs = document.querySelectorAll(".tab");
  const forms = document.querySelectorAll(".auth-form");
  const indicator = document.querySelector(".tab-indicator");

  function activate(name){
    tabs.forEach(t => {
      const on = t.dataset.tab === name;
      t.classList.toggle("is-active", on);
      t.setAttribute("aria-selected", on);
    });
    forms.forEach(f => f.classList.toggle("is-active", f.id === "form-" + name));
    indicator.style.transform = name === "cadastro" ? "translateX(100%)" : "translateX(0)";
  }

  tabs.forEach(t => t.addEventListener("click", () => activate(t.dataset.tab)));
  document.querySelectorAll(".link-switch").forEach(b =>
    b.addEventListener("click", () => activate(b.dataset.target))
  );

  if (window.location.hash === "#cadastro") activate("cadastro");
</script>

</body>
</html>