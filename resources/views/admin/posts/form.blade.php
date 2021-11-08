@extends('layouts/app')

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/{{env('TINYMCE_KEY')}}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
    @if (isset($post))
        <h1>Editer l'article {{ $post->title }}</h1>
        <form method="post" action="{{ $post->modifyLink() }}">
        @method('PUT')
    @else
        <h1>créer un article</h1>
        <form method="post" action="/admin/posts/add">
    @endif
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="title" value="{{ isset($post) ? $post->title : null}}" placeholder="title">
            <label class="form-label">Titre</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="slug" value="{{ $post->slug }}" placeholder="slug">
            <label class="form-label">Description</label>
        </div>
        <x:tiny-mce name="text" :text="isset($post) ? $post->text : null" />
    @csrf
        <input class="btn btn-success" type="submit">
    </form>

@endsection