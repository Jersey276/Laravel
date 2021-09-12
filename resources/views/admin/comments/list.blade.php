@extends('layouts/app')
@section('content')
    <h2>commentaires de l'article {{ $post->title }}</h2>
    <ul class="list-group">
        @foreach($post->comments as $comment)
        <li class="list-group-item d-flex flex-column p-0">
            <div class="d-flex flex-row p-3 bg-light">
                <div class="me-auto my-auto">
                    <btn data-bs-toggle="collapse" data-bs-target="#collapse-{{$comment->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                        {{$comment->author->name}}
                        {{$comment->created_at}}
                    </btn>
                </div>
                <form method="post" action="{{$comment->removeLink()}}" id="delete-{{$post->id}}">
                    @method('DELETE')
                    @csrf
                </form>
                <input class="btn btn-danger" type="submit" value="Supprimer" id="delete-{{$post->id}}">
            </div>
            <div class="collapse" id="collapse-{{$comment->id}}">
                <div class="card card-body border-0 border-top rounded-0">
                    {{$comment->comment}}
                </div>
            </div>
        </li>
        @endforeach
    </ul>
@endsection