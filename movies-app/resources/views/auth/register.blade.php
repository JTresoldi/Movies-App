@extends('layout')
@section('title', 'Registrar')

@section('content')
  <h2>Registrar</h2>

  <div class="auth-card">
    {{-- erros globais (opcional) --}}
    @if($errors->any())
      <ul class="error" style="margin:0 0 10px 0;">
        @foreach($errors->all() as $erro)
          <li>{{ $erro }}</li>
        @endforeach
      </ul>
    @endif

    <form action="{{ route('register') }}" method="POST" novalidate>
      @csrf

      <div class="field">
        <label for="name">Nome</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        @error('name') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="field">
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="field">
        <label for="password">Senha</label>
        <input id="password" type="password" name="password" required>
        @error('password') <div class="error">{{ $message }}</div> @enderror
      </div>

      {{-- opcional: confirmação de senha (se validar 'confirmed' no controller) --}}
      {{-- 
      <div class="field">
        <label for="password_confirmation">Confirmar senha</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
      </div>
      --}}

      <div class="auth-actions">
        <button type="submit" class="btn">Criar conta</button>
        <a class="link-muted" href="{{ route('login.form') }}">Já tenho conta</a>
      </div>
    </form>
  </div>
@endsection
