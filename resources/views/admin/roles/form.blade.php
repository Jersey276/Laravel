@extends('layouts/app')

@section('content')

@empty($editRole)
    <form method="post">
        @csrf
        <label for="name">Nom du role</label>
        <input type="text" name="name" class="form-control">
@else 
    <form method="post" action="{{$editRole->name}}">
        @csrf
        @method('patch')
        <label for="name">Nom du role</label>
        <input type="text" name="name" class="form-control" value="{{$editRole->name}}">
@endempty
    
    @if (isset($editRole) && $editRole->name === 'user')
        <div class="alert alert-danger">le Role User ne peut avoir de parent</div>
    @else
        @foreach ($roles as $role)
            @if (empty($editRole) || $editRole->name !== $role->name)
                <label for="parents[]">{{$role->name}}</label>
                @if(isset($editRole) && (json_decode($editRole->parents) !== null && in_array($role->name, json_decode($editRole->parents))))
                    <input class="form-check" type="checkbox" name="parents[]" value="{{$role->name}}" checked>
                @else
                    <input class="form-check" type="checkbox" name="parents[]" value="{{$role->name}}">
                @endif
            @endif
        @endforeach
    @endif
    <input type="submit" class="btn btn-success">
</form>
@endsection