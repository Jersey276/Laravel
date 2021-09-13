@extends('layouts/app')
@section('content')
    @if (isset($post))
        <form method="post" action="{{ $post->modifyLink() }}">
        @method('PATCH')
        <input type="text" name="title" value="{{ $post->title }}">
        <input type="text" name="slug" value="{{ $post->slug }}">
        <textarea name="text">{{ $post->text }}</textarea>
    @else
        <form method="post" action="/admin/posts/add">
            <input type="text" name="title">
            <input type="text" name="slug">
        <textarea name="text"></textarea>
    @endif
    @csrf
        <input type="submit">
    </form>

@endsection