@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (isset($post))
                {{ $post->title }}
            @else
                aucun post publié sur le site
            @endif
        </div>
    </div>
</div>
@endsection
