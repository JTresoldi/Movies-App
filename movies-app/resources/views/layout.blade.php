<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Movies App')</title>
  <style>
  :root{
    --bg:#0b0f17; --card:#121826; --muted:#94a3b8; --text:#e2e8f0; --accent:#4f46e5;
  }
  *{box-sizing:border-box}
  body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial;background:var(--bg);color:var(--text)}
  /*Header */
  header{position:sticky;top:0;background:rgba(21,29,44,.7);backdrop-filter:blur(8px);border-bottom:1px solid #1f2937}
  .wrap{max-width:1100px;margin:0 auto;padding:16px}
  /*Alinhamento horizontal no header */
  header .wrap{display:flex;justify-content:space-between;align-items:center;gap:16px}
  .nav{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
  .nav a{display:inline-flex;align-items:center;margin:0}
  .user-nav{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
  .user-nav .muted{opacity:.8}
  .user-nav form{display:inline-block;margin:0}
  .user-nav button{padding:6px 10px;border:1px solid #334155;border-radius:10px;background:#1f2937;color:var(--text);cursor:pointer}
  /*Links e btns */
  nav a{color:var(--text);text-decoration:none;margin-right:12px;opacity:.9}
  nav a:hover{opacity:1}
  .btn{display:inline-block;padding:8px 12px;border-radius:10px;border:1px solid #334155;background:#1f2937;color:var(--text);text-decoration:none}
  .btn:hover{background:#263041}
  input,select,button{padding:10px 12px;border-radius:10px;border:1px solid #334155;background:#0f172a;color:var(--text)}
  button{cursor:pointer}
  /*Home / listas */
  .movie-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin:16px 0;padding:0}
  .movie-card{list-style:none;background:var(--card);border:1px solid #1f2937;border-radius:14px;padding:10px;box-shadow:0 8px 24px rgba(0,0,0,.15)}
  .movie-card a{color:var(--text);text-decoration:none;display:block}
  .movie-card img{width:100%;height:270px;object-fit:cover;border-radius:10px;margin-bottom:8px;display:block}
  .movie-title{font-weight:600;line-height:1.2}
  .movie-meta{font-size:.9rem;color:var(--muted)}
  /*Detalhe */
  .detail{display:grid;grid-template-columns:160px 1fr;gap:16px}
  .detail img{width:160px;height:240px;object-fit:cover;border-radius:12px;border:1px solid #1f2937}
  .actions form{display:inline-block;margin:6px 6px 0 0}
  /*Auth cards */
  .auth-card{max-width:420px;margin:24px auto;background:var(--card);border:1px solid #1f2937;border-radius:14px;padding:16px;box-shadow:0 8px 24px rgba(0,0,0,.15)}
  .field{display:grid;gap:6px;margin:10px 0}
  .field label{font-size:.95rem;opacity:.9}
  .error{color:#fca5a5;font-size:.9rem}
  .auth-actions{display:flex;gap:8px;align-items:center;justify-content:space-between;margin-top:12px}
  .link-muted{opacity:.85;text-decoration:none}
  .link-muted:hover{opacity:1;text-decoration:underline}
  </style>
</head>
<body>
<header>
  <div class="wrap">
    <nav class="nav">
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('listas.public') }}">Listas públicas</a>
      @auth
        <a href="{{ route('listas.index') }}">Minhas listas</a>
      @endauth
    </nav>

    <div class="user-nav">
      @auth
        <a href="{{ route('perfil') }}">Meu perfil</a>
        <span class="muted">{{ \Illuminate\Support\Str::limit(Auth::user()->name, 20) }}</span>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit">Sair</button>
        </form>
      @endauth
      @guest
        <a href="{{ route('login.form') }}" class="btn">Entrar</a>
        <a href="{{ route('register.form') }}" class="btn">Registrar</a>
      @endguest
    </div>
  </div>
</header>
  @if(session('ok'))<p>{{ session('ok') }}</p>@endif
  @if($errors->any())
    <ul>@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>
  @endif
  <main>
    @yield('content')
  </main>
</body>
</html>
