<div align="center">
    <img src="https://readme-typing-svg.demolab.com?font=Fira+Code&pause=1000&color=244AF7&width=435&lines=Hello!+I'm+Jo%C3%A3o+P+Tresoldi!+%F0%9F%91%8B%F0%9F%91%91" alt="Hello! I'm João P Tresoldi" />
  
  <h3>💻 Backend Developer</h3>

  <p align="center">
    <a href="https://www.linkedin.com/in/jtresoldi/" target="_blank" rel="noopener noreferrer">
      <img src="https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white" alt="LinkedIn"/>
    </a>
  </p>

---
# Movies App (Laravel + TMDB)
### Aplicação web em PHP/Laravel que consome a API do The Movie Database (TMDB) para:

* listar filmes populares
* buscar filmes com filtro por gênero
* ver detalhes de cada filme
* autenticar usuários (registrar/login/logout)
* criar listas pessoais de filmes (privadas ou públicas)
* exibir perfil do usuário (privado) e perfil público (/u/{user}) com suas listas públicas
#### Foco da avaliação: lógica de programação, consumo de API, autenticação, CRUD simples e autorização.
---
### Requisitos
* PHP 8.1+ (8.2 recomendado)
* Composer
* SQLite (sem servidor) ou MySQL (opcional)
* Chave da API TMDB (v3) — crie em: https://www.themoviedb.org/settings/api
---
### Stack / principais libs
* Laravel 10/11
* Laravel HTTP Client (Guzzle) p/ consumir TMDB
* SQLite (migrations/seeders prontos)
* Blade (views) + CSS leve no layout.blade.php 
---
### Funcionalidade
* Home (/): filmes populares da TMDB
* Buscar (/buscar): por texto e filtro de gênero
* Detalhe (/filme/{id}): infos do filme; adicionar a lista
* Auth: registrar, login, logout
* Perfil
    * Privado (/perfil, /perfil/editar): ver/editar nome, e-mail, senha
    * Público (/u/{user}): mostra listas públicas do usuário
* Listas
    * Minhas listas (/listas), criar (/listas/criar)
    * Marcar pública/privada
    * Adicionar/remover filmes
    * Explorar listas públicas (/listas-publicas, /listas-publicas/{lista})
---
* GET / — Home (populares)
* GET /buscar?q=&genero=&page= — Busca por texto e/ou gênero
* GET /filme/{id} — Detalhe do filme
* GET /login, POST /login
* GET /registrar, POST /registrar
* POST /logout
* GET /perfil — privado
* GET /perfil/editar, POST /perfil — atualizar dados
* GET /u/{user} — perfil público
* GET /listas — Minhas listas
* GET /listas/criar, POST /listas — Criar
* GET /listas/{lista} — Ver lista (privada do dono)
* POST /listas/{lista}/adicionar — Add filme
* DELETE /listas/{lista}/remover/{movie} — Remover
* GET /listas-publicas, GET /listas-publicas/{lista} — Público
---
### Banco de dados (migrations)
* users
* movie_lists
    * id, user_id (FK), name, is_public:boolean, timestamps
* movie_list_items
    * id, movie_list_id (FK), movie_id (ID TMDB), timestamps
---
### UX/UI
* Layout simples e responsivo (CSS no layout.blade.php)
* Header fixo com navegação e auth
* Grid de cards com pôster, título, ano
* Lazy loading de imagens
* Estados vazios e mensagens de feedback
---
### Como testar (roteiro de demo — 1 a 2 min)
1. Registrar e logar.
2. Criar lista pública.
3. Home → abrir um filme → Adicionar à lista.
4. Minhas listas → ver/remover filme.
5. Listas públicas → abrir sua lista pública.
6. Buscar por gênero (ex.: Ação) → navegar páginas.
7. Perfil/editar (trocar nome/e-mail/senha).
8. Perfil público /u/{id} com as listas públicas.
---
### Limitações e próximos passos
* Sem favoritos/ratings/comentários.
* Cache opcional dos detalhes do filme para listas.
* Melhorar acessibilidade (foco/teclas), testes automatizados.
* Filtros extras (ano, adulto), ordenar por data/nota.
---
