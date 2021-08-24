@extends('layouts/app')
@section('content')
<h1>{{ $post->title }}</h1>
{{ $post->slug }}<br>
{{ $post->text }}<br>
{{ $post->created_at }}<br>
<a href="{{ $post->modifyLink() }}">Modifier</a><br>
<form method="POST" action="{{ $post->removeLink() }}">
    @method('DELETE')
    @csrf
    <input type="submit" value="Supprimer">
</form><br>
{{ $post->user->name }}
@endsection