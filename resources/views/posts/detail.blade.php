@extends('layouts/app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h1 class="card-title">{{ $post->title }}</h1>
        <p class="card-subtitle">{{ $post->slug }}</p>
    </div>
    <div class="card-body">
        <p class="card-text">{{ $post->text }}</p>
    </div>
    <div class="card-footer">
        {{ $post->author->name }} le {{ $post->created_at }}
    </div>
</div>
@if (Auth::user())
    <form method="post" method='{{ $post->displayLink() }}'>
        @csrf
        <textarea class="form-control" name="comment"></textarea>
        <button class="btn btn-outline-success" type="submit">poster le commentaire</button>
    </form>
@endif
<div class="list-group-flush">
    @foreach ($post->comments as $comment)
        <div clas="list-group-item">
            <div class="d-flex w-100 justify-content-between mb-1">
                <h5>{{ $comment->author->name }}</h5>
                <small>{{ $comment->created_at }}</small>
            </div>
            <div>{!! nl2br(e($comment->comment)) !!}</div>
        </div>
    @endforeach
</div>
@endsection