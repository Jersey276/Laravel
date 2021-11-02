@extends('layouts/app')

@section('content')
<div class="w-25 float-end card">
    <div class="card-header">

    </div>
    <div class="card-body">
        {{ $project->slug }}
        {{ $project->technology }}
        {{ $project->startedAt }}
        {{ $project->finishedAt }}
    </div>
</div>
<h1>{{ $project->title }}</h1>
{{ $project->text }}
@endsection