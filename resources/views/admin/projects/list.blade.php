@extends('layouts/app')

@section ('content')
    <a href="/admin/projects/add" class="btn btn-success">nouveau projet</a>
    <div class="list-group-flush">
        @foreach ($projects as $project)
            @include('admin/projects/card')
        @endforeach
    </div>
@endsection