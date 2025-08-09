@extends('layout')
@section('title', 'Buscar')
@section('content')
  <h1>Resultados para: "{{ $query }}"</h1>

  <form action="{{ route('buscar') }}" method="GET" style="display:flex;gap:8px;flex-wrap:wrap;margin:12px 0;">
    <input type="text" name="q" placeholder="Buscar filmes..." value="{{ $query }}" style="flex:1;min-width:200px;">

    @if(isset($genres) && count($genres))
      <select name="genero">
        <option value="">-- Gênero --</option>
        @foreach($genres as $g)
          <option value="{{ $g['id'] }}" {{ (string)($genero ?? '') === (string)$g['id'] ? 'selected' : '' }}>
            {{ $g['name'] }}
          </option>
        @endforeach
      </select>
    @endif

    <button type="submit" class="btn">Buscar</button>
    <a href="{{ route('home') }}" class="btn">Limpar</a>
  </form>

  @if(count($filmes) > 0)
    <ul class="movie-grid">
      @foreach ($filmes as $filme)
        <li class="movie-card">
          <a href="{{ route('filme.detalhes', $filme['id']) }}">
            @if(!empty($filme['poster_path']))
              <img loading="lazy" src="https://image.tmdb.org/t/p/w342{{ $filme['poster_path'] }}" alt="{{ $filme['title'] }}">
            @endif
            <div class="movie-title">{{ $filme['title'] }}</div>
            @if(!empty($filme['release_date']))
              <div class="movie-meta">{{ \Illuminate\Support\Str::of($filme['release_date'])->substr(0,4) }}</div>
            @endif
          </a>
        </li>
      @endforeach
    </ul>
  @else
    <p>Nenhum filme encontrado.</p>
  @endif

  {{-- paginação (se você implementou no controller) --}}
  @if(($totalPages ?? 1) > 1)
    <nav style="display:flex;gap:8px;align-items:center;margin-top:12px;">
      @php
        $paramsPrev = ['q' => $query, 'genero' => $genero, 'page' => max(1, ($page ?? 1) - 1)];
        $paramsNext = ['q' => $query, 'genero' => $genero, 'page' => ($page ?? 1) + 1];
      @endphp

      @if(($page ?? 1) > 1)
        <a class="btn" href="{{ route('buscar', $paramsPrev) }}">← Anterior</a>
      @else
        <span class="btn" style="opacity:.5;pointer-events:none;">← Anterior</span>
      @endif

      <span style="opacity:.8;">Página {{ $page }} de {{ $totalPages }}</span>

      @if(($page ?? 1) < ($totalPages ?? 1))
        <a class="btn" href="{{ route('buscar', $paramsNext) }}">Próxima →</a>
      @else
        <span class="btn" style="opacity:.5;pointer-events:none;">Próxima →</span>
      @endif
    </nav>
  @endif
@endsection
