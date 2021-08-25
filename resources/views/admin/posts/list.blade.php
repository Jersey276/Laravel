@extends('layouts/app')

@section('content')
    <a class="btn btn-primary" href="/admin/posts/add">Nouveau Post</a>
    @if(!empty($posts))
    <ul class='list-group'>
        @foreach($posts as $post)
            <li class='list-group-item list-group-item-action d-flex flex-row justify-content-around'>
                <div class="me-auto">
                <a href="{{ $post->displayLink()}}"><h2 class="">{{ $post->title }}</h2></a>
                    {{ $post->slug }}
                </div>
                <form method="POST" action="{{ $post->removeLink() }}" id="removeForm-{{ $post->id }}">
                    @method('DELETE')
                    @csrf

                </form><br>
                <div class="mt-auto btn-group">
                    <a class="btn btn-warning" href="{{ $post->modifyLink() }}">modifier</a><br>
                    <button class="btn btn-danger" type="submit" form="removeForm-{{ $post->id }}">supprimer</button>
                </div>
            </li>
        @endforeach
    </ul>
    @else
        aucun post disponible
        <a href="/admin/posts/add">Nouveau Post</a>
    @endif
@endsection