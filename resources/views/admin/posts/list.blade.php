@extends('layouts/app')

@section('content')
    <a class="btn btn-primary" href="/admin/posts/add">Nouveau Post</a>
    @if(!empty($posts))
    <ul class='list-group'>
        @foreach($posts as $post)
            <li class='list-group-item list-group-item-action'>
                <div>
                <a href="{{ $post->displayLink(true)}}"><h2 class="list-group- ">{{ $post->title }}</h2></a>
                    {{ $post->slug }}
                </div>
                <a class="btn btn-outline-dark" href="{{ $post->modifyLink() }}">modifier</a><br>
                <form method="POST" action="{{ $post->removeLink() }}">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-outline-dark" type="submit">Button</button>
                </form><br>
            </li>
        @endforeach
    </ul>
    @else
        aucun post disponible
        <a href="/admin/posts/add">Nouveau Post</a>
    @endif
@endsection