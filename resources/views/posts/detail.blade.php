@extends('layouts/app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h1 class="card-title">{{ $post->title }}</h1>
        <i class="card-subtitle">{{ $post->slug }}</i>
    </div>
    <div class="card-body">
        <p class="card-text">{!! $post->text !!}</p>
    </div>
    <div class="card-footer">
        <a class="link-dark text-decoration-none" href="{{ $post->author->displayLink()}}">{{ $post->author->name }}</a> le {{ $post->created_at }}
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
        <div class="list-group-item d-flex flex-row">
            <div class="align-self-start">
                <a class="" href="{{$comment->author->displayLink()}}">
                    @if ($comment->author->avatar)
                        <img class="rounded-circle" src="{{asset('storage/avatar/'. $comment->author->avatar)}}" style="width:80px;height:80px;">
                    @else
                        <img class="rounded-circle" src="{{asset('storage/avatar/default.png')}}" style="width:80px;height:80px;">
                    @endif
                </a>
            </div>
            <div class="flex-grow-1 d-flex flex-column">
                <div class="d-flex w-100 justify-content-between mb-1">
                    <h5>{{ $comment->author->name }}</h5>
                    <small>{{ $comment->created_at }}</small>
                </div>
                <div>{!! nl2br($comment->comment) !!}</div>
            </div>
        </div>
    @endforeach
</div>
@endsection