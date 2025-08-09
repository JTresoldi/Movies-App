@extends('layout')
@section('title', 'Editar Perfil')
@section('content')
<h2>Editar Perfil</h2>

@if(session('ok')) <p>{{ session('ok') }}</p> @endif

<form action="{{ route('perfil.atualizar') }}" method="POST">
  @csrf

  <div>
    <label>Nome</label><br>
    <input name="name" value="{{ old('name', $user->name) }}" required>
    @error('name') <div>{{ $message }}</div> @enderror
  </div>

  <div>
    <label>E-mail</label><br>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    @error('email') <div>{{ $message }}</div> @enderror
  </div>

  <div>
    <label>Nova senha (opcional)</label><br>
    <input type="password" name="password" placeholder="Deixe em branco para manter">
    @error('password') <div>{{ $message }}</div> @enderror
  </div>

  <button>Salvar</button>
</form>

<p style="margin-top:10px;">
  <a href="{{ route('perfil') }}">← Voltar ao perfil</a>
  | <a href="{{ route('perfil.publico', auth()->user()) }}">Ver meu perfil público</a>
</p>
@endsection
