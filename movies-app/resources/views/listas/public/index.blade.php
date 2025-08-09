@extends('layout')
@section('content')
<h2>Listas Públicas</h2>
<ul>
  @foreach($lists as $l)
    <li><a href="{{ route('listas.public.show', $l) }}">
      {{ $l->name }} — {{ $l->user->name }}
    </a></li>
  @endforeach
</ul>
@endsection
