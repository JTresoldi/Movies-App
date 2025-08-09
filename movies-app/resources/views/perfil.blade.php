@extends('layout')
@section('title', $filme['title'] ?? 'Detalhes')
@section('content')
  <h2>Olá, {{ Auth::user()->name }}</h2>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Sair</button>
    </form>

    <p><a href="{{ route('home') }}">← Voltar à Home</a></p>
@endsection
