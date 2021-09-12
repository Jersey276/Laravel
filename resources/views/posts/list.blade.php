@extends('layouts/app')

@section('content')
    @if(!empty($posts))
    <div class="list-group">
        @foreach($posts as $post)
                <a class="list-group-item list-group-item-action" href="{{ $post->displayLink()}}"><h2>{{ $post->title }}</h2>
                    {{ $post->slug }}
                </a>
        @endforeach
    </div>
    @else
        aucun post disponible
    @endif
@endsection