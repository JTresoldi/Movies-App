@extends('layout')
@section('title', 'Lista: ' . $lista->name)
@section('content')
  <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
    <h2 style="margin:0;">Lista: {{ $lista->name }}</h2>
    <span class="btn" style="pointer-events:none;opacity:.9;">
      {{ $lista->is_public ? 'Pública' : 'Privada' }}
    </span>
  </div>

  <div style="margin:8px 0;opacity:.8;">
    {{ count($filmes) }} {{ count($filmes) === 1 ? 'filme' : 'filmes' }}
  </div>

  <p style="margin:8px 0;">
    <a class="btn" href="{{ route('listas.index') }}">← Minhas listas</a>
    @if($lista->is_public)
      <a class="btn" href="{{ route('listas.public.show', $lista) }}">Ver versão pública</a>
    @endif
  </p>

  @if(count($filmes))
    <ul class="movie-grid">
      @foreach($filmes as $filme)
        <li class="movie-card">
          <a href="{{ route('filme.detalhes', $filme['id']) }}">
            @if(!empty($filme['poster_path']))
              <img src="https://image.tmdb.org/t/p/w342{{ $filme['poster_path'] }}" alt="{{ $filme['title'] }}">
            @else
              <div style="width:100%;height:270px;display:grid;place-items:center;border:1px solid #1f2937;border-radius:10px;background:#0f172a;color:#94a3b8;">
                Sem pôster
              </div>
            @endif
            <div class="movie-title">{{ $filme['title'] }}</div>
            @if(!empty($filme['release_date']))
              <div class="movie-meta">{{ \Illuminate\Support\Str::of($filme['release_date'])->substr(0,4) }}</div>
            @endif
          </a>

          <form action="{{ route('listas.removeMovie', ['lista'=>$lista,'movie'=>$filme['id']]) }}"
                method="POST" style="margin-top:8px;">
            @csrf @method('DELETE')
            <button class="btn">Remover</button>
          </form>
        </li>
      @endforeach
    </ul>
  @else
    <div style="margin-top:12px;padding:16px;border:1px solid #1f2937;background:#121826;border-radius:12px;">
      <p style="margin:0 0 8px;">Nenhum filme nesta lista.</p>
      <p style="margin:0;">
        Que tal explorar <a class="btn" href="{{ route('home') }}">Filmes Populares</a>
        ou <a class="btn" href="{{ route('buscar') }}">fazer uma busca</a> e adicionar?
      </p>
    </div>
  @endif
@endsection
