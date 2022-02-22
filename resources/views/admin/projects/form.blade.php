@extends('layouts/app')

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/{{env('TINYMCE_KEY')}}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')

@isset($project)
    <h1>Modifier le projet {{ $project->title }}</h1>
    <form method="POST" action="{{ $project->modifyLink() }}">
    @method('put')
@else
    <h1>Créer un nouveau projet</h1>
    <form method="POST" action="/admin/projects/add">
@endisset
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control" placeholder="Titre" name="title" value="{{isset($project) ? $project->title : null}}" required>
        <label for="title">Titre du projet</label>
      </div>
    <label class="form-label">Période</label>
    <div class="input-group mb-3">
        <label for="startedAt" class="input-group-text">Début</label>
        <input type="date" class="form-control" name="startedAt" value="{{isset($project) ? $project->startedAt : null}}" required>
        <label for="finishedAt" class="input-group-text">Finit</label>
        <input type="date" class="form-control" name="finishedAt" value="{{isset($project) ? $project->finishedAt : null}}">
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="slug" placeholder="Description du projet" value="{{isset($project) ? $project->slug : null}}">
        <label for="slug" class="form-label">Description du projet</label>
    </div>
        <x-tiny-mce name="text" :text="isset($project) ? $project->text : null"/>*
        <div class="mt-3 d-flex flex-row justify-content-between">
            <div class="form-check form-switch">
                @if (isset($project) && $project->isVisible)
                    <input class="form-check-input" name="isVisible" type="checkbox" id="flexSwitchCheckDefault" checked>
                @else
                    <input class="form-check-input" name="isVisible" type="checkbox" id="flexSwitchCheckDefault">
                @endif
                <label class="form-check-label" for="flexSwitchCheckDefault">Visible</label>
            </div>
            <input type="submit" class="btn btn-success" value="Poster">
        </div>
</form>
@endsection