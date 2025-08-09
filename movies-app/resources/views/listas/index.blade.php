@extends('layout')
@section('content')
<h2>Minhas Listas</h2>
<a href="{{ route('listas.create') }}">+ Criar nova lista</a>
<ul>
    @foreach($lists as $l)
        <li>
          <a href="{{ route('listas.show', $l) }}">{{ $l->name }}</a>
          <form action="{{ route('listas.destroy', $l) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button>🗑️</button>
          </form>
        </li>
    @endforeach
</ul>
@endsection
