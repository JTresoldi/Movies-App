@extends('layout')
@section('content')
<h2>Criar Lista</h2>
<form action="{{ route('listas.store') }}" method="POST">
  @csrf
  <input name="name" placeholder="Nome da lista" required><br>
  <label>
    <input type="checkbox" name="is_public" value="1"> Pública
  </label><br>
  <button>Criar</button>
</form>
@endsection
