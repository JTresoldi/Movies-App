@extends('layout')
@section('title', $filme['title'] ?? 'Detalhes')
@section('content')
@php $minhasListas = $minhasListas ?? collect(); @endphp

  <h1 style="margin-bottom:12px;">{{ $filme['title'] }}</h1>

  <div class="detail">
    @if(!empty($filme['poster_path']))
      <img src="https://image.tmdb.org/t/p/w342{{ $filme['poster_path'] }}" alt="{{ $filme['title'] }}">
    @endif

    <div>
      <p class="movie-meta">
        <strong>Lançamento:</strong> {{ $filme['release_date'] ?? '—' }}
      </p>
      <p>{{ $filme['overview'] ?: 'Sem sinopse.' }}</p>

      <div class="actions">
        @auth
          <h3 style="margin-top:10px;">Adicionar a uma das minhas listas</h3>
          @forelse($minhasListas as $l)
            <form action="{{ route('listas.addMovie', $l->id) }}" method="POST">
              @csrf
              <input type="hidden" name="movie_id" value="{{ $filme['id'] }}">
              <button class="btn">Adicionar em "{{ $l->name }}"</button>
            </form>
          @empty
            <p>Você ainda não tem listas. <a href="{{ route('listas.create') }}">Crie uma agora</a>.</p>
          @endforelse
        @endauth
      </div>
      <p style="margin-top:12px;"><a class="btn" href="{{ route('home') }}">← Voltar</a></p>
    </div>
  </div>
@endsection
