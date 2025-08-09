@extends('layout')
@section('title', 'Entrar')

@section('content')
  <h2>Entrar</h2>

  <div class="auth-card">
    <form action="{{ route('login') }}" method="POST" novalidate>
      @csrf

      <div class="field">
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="field">
        <label for="password">Senha</label>
        <input id="password" type="password" name="password" required>
        @error('password') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="auth-actions">
        <button type="submit" class="btn">Entrar</button>
        <a class="link-muted" href="{{ route('register.form') }}">Criar conta</a>
      </div>
    </form>
  </div>
@endsection
