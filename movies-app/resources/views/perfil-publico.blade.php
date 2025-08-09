@extends('layout')
@section('title', 'Perfil de ' . $user->name)
@section('content')
<h2>Perfil público de {{ $user->name }}</h2>
<p><strong>E-mail:</strong> {{ $user->email }}</p>

<h3>Listas públicas</h3>
@if($publicLists->isEmpty())
  <p>Este usuário não tem listas públicas.</p>
@else
  <ul>
    @foreach($publicLists as $l)
      <li>
        <a href="{{ route('listas.public.show', $l) }}">{{ $l->name }}</a>
      </li>
    @endforeach
  </ul>
@endif

<p style="margin-top:10px;">
  <a href="{{ route('listas.public') }}">← Voltar às listas públicas</a>
</p>
@endsection
