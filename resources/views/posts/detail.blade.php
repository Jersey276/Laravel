@extends('layouts/app')
@section('content')
<h1>{{ $post->title }}</h1>
{{ $post->slug }}<br>
{{ $post->text }}<br>
{{ $post->author->name }} le {{ $post->created_at }}<br>

<form method="post" method='{{ $post->displayLink() }}'>
    @csrf
    <textarea name="comment"></textarea>
    <button type="submit">poster le commentaire</button>
</form>
@foreach ($post->comments as $comment)
    {{ $comment->author->name }} <br>
    {!! nl2br(e($comment->comment)) !!} <br>
    {{ $comment->created_at }} <br>
@endforeach
@endsection