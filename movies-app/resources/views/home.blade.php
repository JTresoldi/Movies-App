@extends('layout')
@section('title', 'Filmes Populares')
@section('content')
  <h1>Filmes Populares</h1>

  <form action="{{ route('buscar') }}" method="GET" style="display:flex;gap:8px;flex-wrap:wrap;margin:12px 0;">
    <input type="text" name="q" placeholder="Buscar filmes..." value="{{ request('q') }}">

    @if(isset($genres) && count($genres))
      <select name="genero">
        <option value="">-- Gênero --</option>
        @foreach($genres as $g)
          <option value="{{ $g['id'] }}" {{ (string)request('genero') === (string)$g['id'] ? 'selected' : '' }}>
            {{ $g['name'] }}
          </option>
        @endforeach
      </select>
    @endif

    <button type="submit" class="btn">Buscar</button>
  </form>

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
@endsection
