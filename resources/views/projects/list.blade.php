@extends('layouts/app')

@section('content')
    @if(!empty($projects))
    <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-5">
        @foreach($projects as $project)
            @include('projects.card')
        @endforeach
    </div>
    @else
        aucun projects disponible
    @endif
@endsection