@extends('layouts/app')

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/{{env('TINYMCE_KEY')}}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')

@isset($project)
    <form method="POST" action="{{ $project->modifyLink() }}">
    @method('put')
@else
    <form method="POST" action="/admin/projects/add">
@endisset
    @csrf
    <div class="form-floating mb-3">
        @isset($project)
        <input type="text" class="form-control" placeholder="Titre" name="title" value="{{$project->title}}" required>
        @else
        <input type="text" class="form-control" placeholder="Titre" name="title" required>
        @endisset
        <label for="title">Titre du projet</label>
      </div>
    <label class="form-label">Période</label>
    <div class="input-group mb-3">
        <label for="startedAt" class="input-group-text">Début</label>
        @isset($project)
            <input type="date" class="form-control" name="startedAt" value="{{$project->startedAt}}" required>
        @else
            <input type="date" class="form-control" name="startedAt" required>
        @endisset
            <label for="finishedAt" class="input-group-text">Finit</label>
        @isset($project)
            <input type="date" class="form-control" name="finishedAt" value="{{$project->finishedAt}}">
        @else
            <input type="date" class="form-control" name="finishedAt">
        @endisset
    </div>
    <div class="form-floating mb-3">
        @isset($project)
            <input type="text" class="form-control" name="slug" placeholder="Description du projet" value="{{$project->slug}}">
        @else
            <input type="text" class="form-control" name="slug" placeholder="Description du projet">
        @endisset
        <label for="slug" class="form-label">Description du projet</label>
    </div>
    <div class="form-floating">
        @isset($project)
            <textarea class="form-control" name="text" placeholder="Description du projet">{{$project->text}}</textarea>
        @else
            <textarea class="form-control" name="text" placeholder="Description du projet"></textarea>
        @endisset
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'advlist autolink lists link image charmap preview hr anchor pagebreak',
                toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | alignleft aligncenter alignright alignjustify | link image media | removeformat help',
                quickbars_image_toolbar: 'alignleft aligncenter alignright | rotateleft rotateright | imageoptions',
                toolbar_mode: 'floating',
                statusbar: false,
            });
        </script>
        <label for="text">Texte</label>
    </div>
    <input type="submit" class="btn btn-success" value="Poster">
</form>
@endsection