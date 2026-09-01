<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Traço — área de trabalho</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/base.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/index.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/workspace.css') }}">
</head>
<body>

<header class="site-header">
  <div class="wrap">
    <a href="{{ url('/home') }}" class="brand">
      <span class="brand-mark"><span>T</span></span>
      Traço
    </a>
    <nav class="main-nav">
      <a href="#projetos" data-tab-link="projetos">Projetos</a>
      <a href="#ambientes" data-tab-link="ambientes">Ambientes</a>
      <a href="#mobilias" data-tab-link="mobilias">Mobílias</a>
      <a href="#modelos" data-tab-link="modelos">Modelos 2D/3D</a>
      <a href="{{ route('api.docs') }}">API</a>
    </nav>
    <div class="nav-actions">
      <form method="POST" action="{{ url('/logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-chalk">Sair</button>
      </form>
    </div>
  </div>
</header>

<section class="workspace-hero blueprint-surface">
  <div class="wrap">
    <span class="eyebrow">Área de trabalho</span>
    <h1>Olá, {{ Auth::user()->name }}.</h1>
    <p>
      Gerencie seus projetos, ambientes, mobílias, modelos e mídias por
      aqui — cada ação abaixo fala diretamente com a API do Traço.
    </p>
  </div>
</section>

<section class="legend" id="stats">
  <div class="wrap legend-inner">
    <div class="legend-item">
      <span class="legend-num" id="stat-projetos">0</span>
      <span class="legend-label">projetos<br><span>cadastrados</span></span>
    </div>
    <div class="legend-item">
      <span class="legend-num" id="stat-ambientes">0</span>
      <span class="legend-label">ambientes<br><span>montados</span></span>
    </div>
    <div class="legend-item">
      <span class="legend-num" id="stat-mobilias">0</span>
      <span class="legend-label">mobílias<br><span>no catálogo</span></span>
    </div>
    <div class="legend-item">
      <span class="legend-num" id="stat-modelos">0</span>
      <span class="legend-label">modelos<br><span>gerados</span></span>
    </div>
  </div>
</section>

<section class="steps blueprint-surface">
  <div class="wrap">
    <span class="eyebrow">Fluxo do projeto</span>
    <div class="steps-row">
      <div class="step">
        <span class="step-n">1</span>
        <h4>Criar projeto</h4>
        <p>Dê um nome e um status — rascunho, em andamento ou finalizado.</p>
      </div>
      <div class="step-line" aria-hidden="true"></div>
      <div class="step">
        <span class="step-n">2</span>
        <h4>Montar ambientes</h4>
        <p>Adicione cômodos com suas dimensões reais.</p>
      </div>
      <div class="step-line" aria-hidden="true"></div>
      <div class="step">
        <span class="step-n">3</span>
        <h4>Posicionar mobílias</h4>
        <p>Encaixe cada peça no modelo com posição e rotação exatas.</p>
      </div>
      <div class="step-line" aria-hidden="true"></div>
      <div class="step">
        <span class="step-n">4</span>
        <h4>Gerar modelo</h4>
        <p>Exporte a visualização 2D ou 3D do ambiente finalizado.</p>
      </div>
    </div>
  </div>
</section>

<main class="wrap workspace-main" id="workspace">
  <nav class="tabs" id="tabs"></nav>
  <div id="tab-panels"></div>
</main>

<footer class="site-footer">
  <div class="wrap">
    <div>
      <strong>Traço</strong><br>
      Estúdio de planejamento de ambientes.
    </div>
    <div>
      <a href="{{ route('api.docs') }}">Referência da API →</a>
    </div>
  </div>
</footer>

<script>
  window.CURRENT_USER_ID = {{ Auth::id() }};
</script>
<script src="{{ asset('frontend/workspace.js') }}"></script>

</body>
</html>
