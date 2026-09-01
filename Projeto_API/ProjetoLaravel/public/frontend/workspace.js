/* ==========================================================================
   TRAÇO — motor de área de trabalho
   Cada recurso abaixo é consumido via fetch() diretamente da API JSON
   (routes/api.php -> Controller -> Service -> Model). Nada aqui grava
   direto no banco: toda escrita passa pela API.
   ========================================================================== */

(function () {
  const API_BASE = '/api';
  const currentUserId = window.CURRENT_USER_ID || null;

  const RESOURCES = {
    projetos: {
      label: 'Projeto',
      labelPlural: 'Projetos',
      endpoint: '/projetos',
      description: 'O contêiner principal de cada trabalho.',
      columns: [
        { key: 'nome', label: 'Nome' },
        { key: 'status', label: 'Status', badge: true },
        { key: 'descricao', label: 'Descrição' },
      ],
      fields: [
        { name: 'nome', label: 'Nome', type: 'text', required: true },
        { name: 'descricao', label: 'Descrição', type: 'textarea' },
        {
          name: 'status', label: 'Status', type: 'select', required: true,
          options: [['rascunho', 'Rascunho'], ['em_andamento', 'Em andamento'], ['finalizado', 'Finalizado']],
        },
      ],
    },
    ambientes: {
      label: 'Ambiente',
      labelPlural: 'Ambientes',
      endpoint: '/ambientes',
      description: 'Os cômodos que compõem um projeto.',
      columns: [
        { key: 'nome', label: 'Nome' },
        { key: 'tipo', label: 'Tipo' },
        { key: 'projeto_id', label: 'Projeto', relation: 'projetos' },
        { key: 'largura', label: 'Largura' },
        { key: 'comprimento', label: 'Comprimento' },
      ],
      fields: [
        { name: 'projeto_id', label: 'Projeto', type: 'select', relation: 'projetos', required: true },
        { name: 'nome', label: 'Nome', type: 'text', required: true },
        { name: 'tipo', label: 'Tipo', type: 'text', required: true, placeholder: 'sala, quarto, cozinha...' },
        { name: 'largura', label: 'Largura (m)', type: 'number', step: '0.01' },
        { name: 'comprimento', label: 'Comprimento (m)', type: 'number', step: '0.01' },
        { name: 'altura', label: 'Altura (m)', type: 'number', step: '0.01' },
      ],
    },
    mobilias: {
      label: 'Mobília',
      labelPlural: 'Mobílias',
      endpoint: '/mobilias',
      description: 'Catálogo de peças disponíveis para uso nos modelos.',
      columns: [
        { key: 'nome', label: 'Nome' },
        { key: 'tipo', label: 'Tipo' },
        { key: 'cor', label: 'Cor' },
        { key: 'dimensao', label: 'Dimensão' },
      ],
      fields: [
        { name: 'nome', label: 'Nome', type: 'text', required: true },
        { name: 'dimensao', label: 'Dimensão', type: 'text', placeholder: '240x96x80cm' },
        { name: 'cor', label: 'Cor', type: 'text' },
        { name: 'tipo', label: 'Tipo', type: 'text', placeholder: 'sofá, mesa, cadeira...' },
      ],
    },
    modelos: {
      label: 'Modelo',
      labelPlural: 'Modelos 2D/3D',
      endpoint: '/modelos',
      description: 'Representação 2D ou 3D gerada para um ambiente.',
      columns: [
        { key: 'nome', label: 'Nome' },
        { key: 'tipo', label: 'Tipo', badge: true },
        { key: 'origem', label: 'Origem' },
        { key: 'ambiente_id', label: 'Ambiente', relation: 'ambientes' },
      ],
      fields: [
        { name: 'ambiente_id', label: 'Ambiente', type: 'select', relation: 'ambientes', required: true },
        { name: 'nome', label: 'Nome', type: 'text', required: true },
        { name: 'tipo', label: 'Tipo', type: 'select', required: true, options: [['2D', '2D'], ['3D', '3D']] },
        { name: 'origem', label: 'Origem', type: 'select', required: true, options: [['IA', 'IA'], ['MANUAL', 'Manual']] },
        { name: 'estilo', label: 'Estilo', type: 'text', placeholder: 'minimalista, industrial...' },
      ],
    },
    'itens-modelos': {
      label: 'Item do modelo',
      labelPlural: 'Itens do modelo',
      endpoint: '/itens-modelos',
      description: 'Cada mobília posicionada dentro de um modelo.',
      columns: [
        { key: 'modelo_id', label: 'Modelo', relation: 'modelos' },
        { key: 'mobilia_id', label: 'Mobília', relation: 'mobilias' },
        { key: 'posicao_x', label: 'X' },
        { key: 'posicao_y', label: 'Y' },
        { key: 'posicao_z', label: 'Z' },
        { key: 'rotacao', label: 'Rotação' },
      ],
      fields: [
        { name: 'modelo_id', label: 'Modelo', type: 'select', relation: 'modelos', required: true },
        { name: 'mobilia_id', label: 'Mobília', type: 'select', relation: 'mobilias', required: true },
        { name: 'posicao_x', label: 'Posição X', type: 'number', step: '0.01', required: true },
        { name: 'posicao_y', label: 'Posição Y', type: 'number', step: '0.01', required: true },
        { name: 'posicao_z', label: 'Posição Z', type: 'number', step: '0.01', required: true },
        { name: 'rotacao', label: 'Rotação (°)', type: 'number', step: '0.01', required: true },
        { name: 'escala', label: 'Escala', type: 'number', step: '0.01', required: true },
      ],
    },
    midias: {
      label: 'Mídia',
      labelPlural: 'Mídias',
      endpoint: '/midias',
      description: 'Imagens e vídeos anexados a um ambiente.',
      columns: [
        { key: 'nome_arquivo', label: 'Arquivo' },
        { key: 'tipo', label: 'Tipo', badge: true },
        { key: 'ambiente_id', label: 'Ambiente', relation: 'ambientes' },
        { key: 'url', label: 'URL' },
      ],
      fields: [
        { name: 'ambiente_id', label: 'Ambiente', type: 'select', relation: 'ambientes', required: true },
        { name: 'tipo', label: 'Tipo', type: 'select', required: true, options: [['imagem', 'Imagem'], ['video', 'Vídeo']] },
        { name: 'nome_arquivo', label: 'Nome do arquivo', type: 'text', required: true },
        { name: 'url', label: 'URL', type: 'text', required: true, placeholder: 'https://...' },
      ],
    },
  };

  const RESOURCE_ORDER = ['projetos', 'ambientes', 'mobilias', 'modelos', 'itens-modelos', 'midias'];

  const cache = {};
  let activeTab = RESOURCE_ORDER[0];
  let editingId = { }; // { [resourceKey]: id|null }

  const tabsEl = document.getElementById('tabs');
  const panelsEl = document.getElementById('tab-panels');

  if (!tabsEl || !panelsEl) return;

  function displayLabel(resourceKey, row) {
    if (!row) return '—';
    return row.nome || row.nome_arquivo || ('#' + row.id);
  }

  function resolveRelation(relationKey, id) {
    const list = cache[relationKey] || [];
    const row = list.find((item) => String(item.id) === String(id));
    return row ? displayLabel(relationKey, row) : '#' + id;
  }

  async function apiRequest(path, options = {}) {
    const res = await fetch(API_BASE + path, {
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      ...options,
    });

    if (res.status === 204) return null;

    let body = null;
    try { body = await res.json(); } catch (e) { body = null; }

    if (!res.ok) {
      const error = new Error((body && body.mensagem) || 'Erro na requisição');
      error.status = res.status;
      error.errors = body && body.errors;
      throw error;
    }

    return body;
  }

  async function loadAll() {
    const entries = await Promise.all(
      RESOURCE_ORDER.map((key) =>
        apiRequest(RESOURCES[key].endpoint).then((data) => [key, Array.isArray(data) ? data : []])
      )
    );
    entries.forEach(([key, data]) => { cache[key] = data; });
    updateStats();
    RESOURCE_ORDER.forEach(renderTable);
    RESOURCE_ORDER.forEach(fillRelationSelects);
  }

  function updateStats() {
    const map = {
      'stat-projetos': 'projetos',
      'stat-ambientes': 'ambientes',
      'stat-mobilias': 'mobilias',
      'stat-modelos': 'modelos',
    };
    Object.entries(map).forEach(([elId, key]) => {
      const el = document.getElementById(elId);
      if (el) el.textContent = (cache[key] || []).length;
    });
  }

  function buildUI() {
    RESOURCE_ORDER.forEach((key, index) => {
      const config = RESOURCES[key];

      const tabBtn = document.createElement('button');
      tabBtn.type = 'button';
      tabBtn.className = 'tab-btn' + (index === 0 ? ' is-active' : '');
      tabBtn.dataset.tab = key;
      tabBtn.textContent = config.labelPlural;
      tabBtn.addEventListener('click', () => switchTab(key));
      tabsEl.appendChild(tabBtn);

      const panel = document.createElement('section');
      panel.className = 'tab-panel' + (index === 0 ? ' is-active' : '');
      panel.dataset.panel = key;

      panel.innerHTML = `
        <header class="panel-head">
          <div>
            <h2>${config.labelPlural}</h2>
            <p>${config.description}</p>
          </div>
          <button type="button" class="btn btn-signal" data-action="new">+ Novo${config.label.endsWith('a') ? 'a' : ''} ${config.label}</button>
        </header>

        <form class="resource-form" data-form="${key}" hidden>
          <div class="resource-form-grid">${buildFieldsMarkup(config)}</div>
          <ul class="form-errors" data-errors hidden></ul>
          <div class="resource-form-actions">
            <button type="submit" class="btn btn-signal">Salvar</button>
            <button type="button" class="btn btn-outline-ink" data-action="cancel">Cancelar</button>
          </div>
        </form>

        <div class="table-wrap">
          <table class="data-table">
            <thead>
              <tr>
                ${config.columns.map((c) => `<th>${c.label}</th>`).join('')}
                <th class="col-actions">Ações</th>
              </tr>
            </thead>
            <tbody data-table="${key}">
              <tr class="empty-row"><td colspan="${config.columns.length + 1}">Carregando...</td></tr>
            </tbody>
          </table>
        </div>
      `;

      panelsEl.appendChild(panel);

      const form = panel.querySelector('[data-form]');
      form.addEventListener('submit', (event) => handleSubmit(event, key));
      panel.querySelector('[data-action="new"]').addEventListener('click', () => openForm(key, null));
      panel.querySelector('[data-action="cancel"]').addEventListener('click', () => closeForm(key));
    });
  }

  function buildFieldsMarkup(config) {
    return config.fields.map((field) => {
      const id = `f-${config.endpoint.slice(1)}-${field.name}`;
      const required = field.required ? 'required' : '';

      let control = '';
      if (field.type === 'textarea') {
        control = `<textarea id="${id}" name="${field.name}" rows="3" ${required}></textarea>`;
      } else if (field.type === 'select') {
        control = `<select id="${id}" name="${field.name}" ${required} data-relation="${field.relation || ''}"></select>`;
      } else {
        const step = field.step ? `step="${field.step}"` : '';
        const placeholder = field.placeholder ? `placeholder="${field.placeholder}"` : '';
        control = `<input id="${id}" name="${field.name}" type="${field.type}" ${step} ${placeholder} ${required}>`;
      }

      return `<div class="form-field"><label for="${id}">${field.label}</label>${control}</div>`;
    }).join('');
  }

  function fillRelationSelects(resourceKey) {
    const config = RESOURCES[resourceKey];
    config.fields.forEach((field) => {
      if (field.type !== 'select' || !field.relation) return;

      document.querySelectorAll(`select[data-relation="${field.relation}"]`).forEach((select) => {
        const previousValue = select.value;
        const relatedData = cache[field.relation] || [];

        select.innerHTML = '<option value="">Selecione...</option>' +
          relatedData.map((row) => `<option value="${row.id}">${displayLabel(field.relation, row)}</option>`).join('');

        if (previousValue) select.value = previousValue;
      });
    });

    config.fields.forEach((field) => {
      if (field.type !== 'select' || field.relation) return;

      document.querySelectorAll(`#tab-panels [data-form="${resourceKey}"] select[name="${field.name}"]`).forEach((select) => {
        if (select.options.length) return;
        select.innerHTML = '<option value="">Selecione...</option>' +
          field.options.map(([value, label]) => `<option value="${value}">${label}</option>`).join('');
      });
    });
  }

  function renderTable(resourceKey) {
    const config = RESOURCES[resourceKey];
    const tbody = document.querySelector(`tbody[data-table="${resourceKey}"]`);
    if (!tbody) return;

    const rows = cache[resourceKey] || [];

    if (!rows.length) {
      tbody.innerHTML = `<tr class="empty-row"><td colspan="${config.columns.length + 1}">Nenhum${config.label.endsWith('a') ? 'a' : ''} ${config.label.toLowerCase()} cadastrad${config.label.endsWith('a') ? 'a' : 'o'} ainda.</td></tr>`;
      return;
    }

    tbody.innerHTML = rows.map((row) => {
      const cells = config.columns.map((col) => {
        let value = row[col.key];
        if (col.relation) value = resolveRelation(col.relation, row[col.key]);
        if (value === null || value === undefined || value === '') value = '—';
        return col.badge ? `<td><span class="row-badge">${value}</span></td>` : `<td>${value}</td>`;
      }).join('');

      return `
        <tr>
          ${cells}
          <td class="col-actions">
            <button type="button" class="row-btn" data-edit="${row.id}">Editar</button>
            <button type="button" class="row-btn row-btn-danger" data-delete="${row.id}">Remover</button>
          </td>
        </tr>
      `;
    }).join('');

    tbody.querySelectorAll('[data-edit]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const row = rows.find((r) => String(r.id) === btn.dataset.edit);
        openForm(resourceKey, row);
      });
    });
    tbody.querySelectorAll('[data-delete]').forEach((btn) => {
      btn.addEventListener('click', () => handleDelete(resourceKey, btn.dataset.delete));
    });
  }

  function openForm(resourceKey, row) {
    const panel = document.querySelector(`.tab-panel[data-panel="${resourceKey}"]`);
    const form = panel.querySelector('[data-form]');
    const config = RESOURCES[resourceKey];

    fillRelationSelects(resourceKey);

    config.fields.forEach((field) => {
      const input = form.querySelector(`[name="${field.name}"]`);
      if (input) input.value = row ? (row[field.name] ?? '') : '';
    });

    editingId[resourceKey] = row ? row.id : null;
    form.querySelector('[data-errors]').hidden = true;
    form.hidden = false;
    form.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  function closeForm(resourceKey) {
    const panel = document.querySelector(`.tab-panel[data-panel="${resourceKey}"]`);
    const form = panel.querySelector('[data-form]');
    form.reset();
    form.hidden = true;
    editingId[resourceKey] = null;
  }

  async function handleSubmit(event, resourceKey) {
    event.preventDefault();
    const config = RESOURCES[resourceKey];
    const form = event.target;
    const errorsBox = form.querySelector('[data-errors]');
    errorsBox.hidden = true;

    const payload = {};
    config.fields.forEach((field) => {
      const input = form.querySelector(`[name="${field.name}"]`);
      payload[field.name] = input.value === '' ? null : input.value;
    });

    if (resourceKey === 'projetos') payload.user_id = currentUserId;

    const id = editingId[resourceKey];
    const method = id ? 'PUT' : 'POST';
    const path = id ? `${config.endpoint}/${id}` : config.endpoint;

    try {
      await apiRequest(path, { method, body: JSON.stringify(payload) });
      closeForm(resourceKey);
      await loadAll();
    } catch (error) {
      const messages = error.errors
        ? Object.values(error.errors).flat()
        : [error.message];
      errorsBox.innerHTML = messages.map((m) => `<li>${m}</li>`).join('');
      errorsBox.hidden = false;
    }
  }

  async function handleDelete(resourceKey, id) {
    const config = RESOURCES[resourceKey];
    if (!confirm(`Remover est${config.label.endsWith('a') ? 'a' : 'e'} ${config.label.toLowerCase()}?`)) return;

    try {
      await apiRequest(`${config.endpoint}/${id}`, { method: 'DELETE' });
      await loadAll();
    } catch (error) {
      alert(error.message || 'Não foi possível remover.');
    }
  }

  function switchTab(key) {
    activeTab = key;
    tabsEl.querySelectorAll('.tab-btn').forEach((btn) => {
      btn.classList.toggle('is-active', btn.dataset.tab === key);
    });
    panelsEl.querySelectorAll('.tab-panel').forEach((panel) => {
      panel.classList.toggle('is-active', panel.dataset.panel === key);
    });
    history.replaceState(null, '', '#' + key);
  }

  document.querySelectorAll('[data-tab-link]').forEach((link) => {
    link.addEventListener('click', (event) => {
      const key = link.dataset.tabLink;
      if (RESOURCES[key]) {
        event.preventDefault();
        switchTab(key);
        document.getElementById('workspace').scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  buildUI();

  const initialHash = window.location.hash.replace('#', '');
  if (RESOURCES[initialHash]) switchTab(initialHash);

  loadAll().catch((error) => {
    console.error('Falha ao carregar dados da API', error);
  });
})();
