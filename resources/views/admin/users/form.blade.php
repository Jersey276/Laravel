@extends('layouts/app')

@section('content')
<form method="post">
    @csrf
    @method('patch')
    <label for="name">nom d'utilisateur</label>
    <input class="form-control" type="text" name="name" value="{{$user->name}}">
    <label for="email">adresse mail</label>
    <input class="form-control" type="email" name="email" value="{{$user->email}}">
    <label for="role">Role</label>
    <select class="form-select" name="role">
        @foreach($roles as $role)
            @if ($role->name == $user->role->name)
            <option value="{{$role->name}}" selected>{{$role->name}}</option>
            @else
            <option value="{{$role->name}}">{{ $role->name }}</option>
            @endif
        @endforeach
    </select>
    <input class="btn btn-success" type="submit" value="Mettre à jour">
</form>
@endsection