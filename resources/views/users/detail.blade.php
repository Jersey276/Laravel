@extends('layouts\app')

@section('content')
    @if (Auth::user() && Auth::user()->name == $user->name)
        <a href="edit" class="btn btn-warning">Editer votre profil</a>
    @endif
    <div class="d-flex flex-row">
        <div>
            @if ($user->avatar)
                <img class="rounded-circle" src="{{asset('storage/avatar/'. $user->avatar)}}" style="width:150px;height:150px;">
            @else
                <img class="rounded-circle" src="{{asset('storage/avatar/default.png')}}" style="width:150px;height:150px;">
            @endif
        </div>
        <div class="">
            <h1>{{$user->name}}</h1>
            {{$user->role->name}}
        </div>
    </div>
    <i>
        {{$user->biography}}
    </i>
    <h2>Activité</h2>
    <div>
        @foreach ($user->comments as $comment)
            {{$comment->created_at}} - nouveau commentaire pour le poste {{$comment->post->title}} :<br>
            {{$comment->comment}}
        @endforeach
    </div>
@endsection