<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Traço — desenhe cada ambiente antes de montar</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/base.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/index.css') }}">
</head>
<body>

<header class="site-header">
  <div class="wrap">
    <a href="{{ url('/') }}" class="brand">
      <span class="brand-mark"><span>T</span></span>
      Traço
    </a>
    <nav class="main-nav">
      <a href="#ambientes">Ambientes</a>
      <a href="#mobilias">Mobílias</a>
      <a href="#modelos">Modelos 2D/3D</a>
      <a href="{{ route('api.docs') }}">API</a>
    </nav>
    <div class="nav-actions">
      <a href="{{ route('login') }}" class="btn btn-outline-chalk">Entrar</a>
    </div>
  </div>
</header>

<section class="hero blueprint-surface">
  <div class="wrap hero-inner">
    <div class="hero-copy">
      <span class="eyebrow">Planejamento de ambientes · escala 1:1</span>
      <h1>Desenhe o ambiente<br>antes de mover<br>um único móvel.</h1>
      <p class="hero-lead">
        Monte cada cômodo em planta, posicione mobílias com precisão de
        centímetro e gere o modelo 2D ou 3D antes de qualquer decisão
        definitiva.
      </p>
      <div class="hero-cta">
        <a href="{{ route('login') }}" class="btn btn-signal">Criar meu primeiro projeto</a>
        <a href="{{ route('login') }}" class="btn btn-outline-chalk">Já tenho conta</a>
      </div>
    </div>

    <div class="hero-plan" aria-hidden="true">
      <div class="plan-frame">
        <div class="plan-item item-a">
          <span class="tag">Mobília · sofá</span>
          <span class="dim dim-x">x 240</span>
          <span class="dim dim-y">y 96</span>
        </div>
        <div class="plan-item item-b">
          <span class="tag">Mobília · mesa</span>
          <span class="dim dim-rot">⟳ 45°</span>
        </div>
        <div class="plan-item item-c">
          <span class="tag">Ambiente · sala</span>
        </div>
        <div class="plan-cross" style="--cx:22%; --cy:30%"></div>
        <div class="plan-cross" style="--cx:68%; --cy:64%"></div>
        <span class="plan-caption">planta.ambiente · escala 1:50</span>
      </div>
    </div>
  </div>
</section>

<section class="legend">
  <div class="wrap legend-inner">
    <div class="legend-item">
      <span class="legend-num">03</span>
      <span class="legend-label">eixos por peça<br><span>x · y · z</span></span>
    </div>
    <div class="legend-item">
      <span class="legend-num">2D/3D</span>
      <span class="legend-label">saída do<br><span>modelo gerado</span></span>
    </div>
    <div class="legend-item">
      <span class="legend-num">∞</span>
      <span class="legend-label">ambientes por<br><span>projeto</span></span>
    </div>
    <div class="legend-item">
      <span class="legend-num">API</span>
      <span class="legend-label">integração<br><span>aberta e documentada</span></span>
    </div>
  </div>
</section>

<section class="features" id="ambientes">
  <div class="wrap">
    <span class="eyebrow eyebrow-ink">O que compõe um projeto</span>
    <div class="features-grid">
      <article class="feature-card" id="mobilias">
        <span class="feature-index">01</span>
        <h3>Mobílias</h3>
        <p>Catalogue peças com dimensão, cor e tipo. Cada mobília carrega
        seus próprios dados técnicos, prontos para entrar em qualquer
        ambiente.</p>
        <ul class="feature-fields">
          <li>nome</li><li>dimensão</li><li>cor</li><li>tipo</li>
        </ul>
      </article>
      <article class="feature-card">
        <span class="feature-index">02</span>
        <h3>Ambientes</h3>
        <p>Defina largura, comprimento e altura de cada cômodo do projeto
        e organize quantos ambientes forem necessários.</p>
        <ul class="feature-fields">
          <li>largura</li><li>comprimento</li><li>altura</li>
        </ul>
      </article>
      <article class="feature-card" id="modelos">
        <span class="feature-index">03</span>
        <h3>Modelos 2D/3D</h3>
        <p>Posicione cada item do modelo com posição, rotação e escala
        exatas — gerado manualmente ou por IA.</p>
        <ul class="feature-fields">
          <li>posição x/y/z</li><li>rotação</li><li>escala</li>
        </ul>
      </article>
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

<section class="final-cta">
  <div class="wrap final-cta-inner">
    <h2>Seu próximo ambiente<br>começa em planta.</h2>
    <a href="{{ route('login') }}" class="btn btn-outline-ink">Criar conta gratuita</a>
  </div>
</section>

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

</body>
</html>
