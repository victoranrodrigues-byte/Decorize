<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Funcionalidades — Traço</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/base.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/api.css') }}">
</head>
<body>

<header class="site-header">
  <div class="wrap">
    <a href="{{ url('/') }}" class="brand">
      <span class="brand-mark"><span>T</span></span>
      Traço
    </a>
    <nav class="main-nav">
      <a href="{{ url('/') }}">Página inicial</a>
      <a href="{{ route('login') }}">Entrar</a>
    </nav>
    <div class="nav-actions">
      <a href="#funcionalidades" class="btn btn-outline-chalk">Ver funcionalidades</a>
    </div>
  </div>
</header>

<section class="api-hero blueprint-surface">
  <div class="wrap">
    <span class="eyebrow">O que o Traço faz</span>
    <h1>Funcionalidades da plataforma</h1>
    <p>Do primeiro rascunho ao modelo pronto: veja tudo o que dá para
    fazer dentro do Traço, organizado por etapa do seu projeto.</p>
  </div>
</section>

<section class="capabilities-legend">
  <div class="wrap capabilities-legend-inner">
    <span class="cap-badge cap-create">Criar</span>
    <span class="cap-badge cap-view">Consultar</span>
    <span class="cap-badge cap-edit">Editar</span>
    <span class="cap-badge cap-remove">Remover</span>
    <span class="cap-note">disponível em cada funcionalidade abaixo</span>
  </div>
</section>

<main class="wrap api-main" id="funcionalidades">
  <div class="features-grid-full">

    <article class="feature-card">
      <span class="feature-index">01</span>
      <h3>Usuários</h3>
      <p>Crie sua conta e mantenha o acesso ao estúdio sob controle,
      com login individual para cada pessoa do time.</p>
      <ul class="feature-fields">
        <li>nome</li><li>e-mail</li><li>senha</li>
      </ul>
    </article>

    <article class="feature-card">
      <span class="feature-index">02</span>
      <h3>Projetos</h3>
      <p>Organize cada trabalho como um projeto separado, com nome,
      descrição e status para acompanhar o andamento — rascunho, em
      andamento ou finalizado.</p>
      <ul class="feature-fields">
        <li>nome</li><li>descrição</li><li>status</li>
      </ul>
    </article>

    <article class="feature-card">
      <span class="feature-index">03</span>
      <h3>Ambientes</h3>
      <p>Monte os cômodos que compõem um projeto, definindo a largura,
      o comprimento e a altura reais de cada espaço.</p>
      <ul class="feature-fields">
        <li>largura</li><li>comprimento</li><li>altura</li>
      </ul>
    </article>

    <article class="feature-card">
      <span class="feature-index">04</span>
      <h3>Mobílias</h3>
      <p>Construa um catálogo de peças com nome, dimensão, cor e tipo,
      prontas para serem usadas em qualquer ambiente do projeto.</p>
      <ul class="feature-fields">
        <li>nome</li><li>dimensão</li><li>cor</li><li>tipo</li>
      </ul>
    </article>

    <article class="feature-card">
      <span class="feature-index">05</span>
      <h3>Modelos 2D/3D</h3>
      <p>Gere a representação de um ambiente em 2D ou 3D, criada
      manualmente ou com apoio de IA, escolhendo o estilo desejado.</p>
      <ul class="feature-fields">
        <li>tipo (2D/3D)</li><li>origem (IA/Manual)</li><li>estilo</li>
      </ul>
    </article>

    <article class="feature-card">
      <span class="feature-index">06</span>
      <h3>Itens do modelo</h3>
      <p>Posicione cada mobília dentro do modelo com posição, rotação
      e escala exatas, peça por peça.</p>
      <ul class="feature-fields">
        <li>posição x/y/z</li><li>rotação</li><li>escala</li>
      </ul>
    </article>

    <article class="feature-card">
      <span class="feature-index">07</span>
      <h3>Mídias</h3>
      <p>Anexe imagens e vídeos a um ambiente para guardar referências,
      inspirações e o resultado final.</p>
      <ul class="feature-fields">
        <li>tipo (imagem/vídeo)</li><li>arquivo</li>
      </ul>
    </article>

  </div>
</main>

<section class="final-cta">
  <div class="wrap final-cta-inner">
    <h2>Pronto para colocar<br>seu projeto em planta?</h2>
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
      <a href="{{ url('/') }}">← Página inicial</a>
    </div>
  </div>
</footer>

</body>
</html>
