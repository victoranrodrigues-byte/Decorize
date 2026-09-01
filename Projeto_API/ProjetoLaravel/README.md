# Traço — estúdio de planejamento de ambientes

Traço é uma aplicação Laravel para planejar ambientes antes de montá-los:
criar projetos, montar cômodos (ambientes), catalogar mobílias e gerar
modelos 2D/3D com os itens posicionados dentro de cada um.

## Arquitetura

O projeto segue a separação de responsabilidades trabalhada em aula:

```
Interface/Tela (Blade + JS)  →  API (routes/api.php)  →  Controller  →  Service  →  Model  →  Banco de Dados
```

- **Controllers** (`app/Http/Controllers`) recebem a requisição HTTP, validam
  os dados de entrada e chamam o Service correspondente — nenhuma regra de
  negócio fica na Controller.
- **Services** (`app/Services`) concentram a lógica de cada caso de uso
  (criar, listar, atualizar, remover) para cada recurso.
- **Models** (`app/Models`) representam as entidades do domínio, herdam de
  `Eloquent\Model` e guardam as relações entre elas.
- O **frontend** (`resources/views`, `public/frontend/workspace.js`) não
  acessa o banco diretamente: toda leitura e escrita passa pela API JSON em
  `/api/*`, consumida via `fetch()`.

## Funcionalidades Implementadas

Cada funcionalidade abaixo está disponível de ponta a ponta (tela → API →
Controller → Service → Model → banco de dados), na área de trabalho
(`/home`, após login):

1. Registrar usuário (criar conta)
2. Autenticar usuário (login)
3. Encerrar sessão (logout)
4. Cadastrar projeto
5. Listar projetos
6. Atualizar projeto
7. Excluir projeto
8. Cadastrar ambiente (vinculado a um projeto)
9. Listar ambientes
10. Atualizar ambiente
11. Excluir ambiente
12. Cadastrar mobília
13. Listar mobílias
14. Atualizar mobília
15. Excluir mobília
16. Gerar modelo 2D/3D (vinculado a um ambiente)
17. Listar modelos
18. Atualizar modelo
19. Excluir modelo
20. Posicionar item de mobília dentro de um modelo (posição x/y/z, rotação, escala)
21. Listar itens de um modelo
22. Atualizar item do modelo
23. Excluir item do modelo
24. Anexar mídia (imagem/vídeo) a um ambiente
25. Listar mídias
26. Atualizar mídia
27. Excluir mídia

## Rodando o projeto

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build
php artisan serve
```

- Página pública: `/`
- Login / cadastro: `/login` e `/registrar`
- Área de trabalho (autenticada): `/home`
- Documentação de funcionalidades: `/docs-api`
- API JSON: `/api/*` (usuários, projetos, ambientes, mobílias, modelos,
  itens-modelos, mídias)

## Stack

Laravel 13, Blade, SQLite (padrão de desenvolvimento), JavaScript puro no
frontend (sem framework de build para a área de trabalho).
