@extends('layouts/app')
@section('content')
<h1>{{ $post->title }}</h1>
{{ $post->slug }}<br>
{{ $post->text }}<br>
{{ $post->created_at }}<br>

{{ $post->user->name }}
@endsection