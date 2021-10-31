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
        <h2> Rôles parents </h2>
        <div class="row">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                @foreach ($roles as $role)
                    <div class="form-check form-switch">
                        @if (empty($editRole) || $editRole->name !== $role->name)
                            <label class="form-check-label" for="parents[]">{{$role->name}}</label>
                            @if(isset($editRole) && (json_decode($editRole->parents) !== null && in_array($role->name, json_decode($editRole->parents))))
                                <input class="form-check-input" type="checkbox" name="parents[]" value="{{$role->name}}" checked>
                            @else
                                <input class="form-check-input" type="checkbox" name="parents[]" value="{{$role->name}}">
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <input type="submit" class="btn btn-success">
</form>
@endsection