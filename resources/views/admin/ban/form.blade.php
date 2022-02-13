@extends('layouts.app')

@section('content')
<div class="alert alert-danger">
    <h1 class="text-center">Nouveau dossier de banissement</h1>
    <form method="POST" action="{{$user->adminBanLink()}}">
        @csrf
        <div class="d-flex flex-row justify-content-around">
            <div>
                <label for="user">Utilisateur concerné</label>
                <input class="form-control-plaintext" name="user" value="{{$user->name}}" readonly>
            </div>
            <div>
                <label for="judge">Juge du dossier</label>
                <input class="form-control-plaintext" name="judge" value="{{$judge->name}}">
            </div>
        </div>
        <label for="banType">Raison</label>
        <select class="form-control" name="bantype">
            @foreach ($banType as $type)
                <option value="{{$type->id}}">{{$type->name}} - {{$type->slug}}</option> 
            @endforeach
        </select>
        <label for="commentary">Commentaire</label>
        <textarea class="form-control" name="commentary"></textarea>
        <input type="submit" class="btn btn-danger" value="Bannir">
    </form>
</div>
@endsection