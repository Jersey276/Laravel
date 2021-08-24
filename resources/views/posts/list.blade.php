@extends('layouts/app')

@section('content')
    @if(!empty($posts))
    <ul>
        @foreach($posts as $post)
            <li>
                <div>
                <a href="{{ $post->displayLink()}}"><h2>{{ $post->title }}</h2></a>
                    {{ $post->slug }}
                </div>
            </li>
        @endforeach
    </ul>
    @else
        aucun post disponible
    @endif
@endsection