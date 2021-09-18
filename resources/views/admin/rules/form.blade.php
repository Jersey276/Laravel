@extends('layouts/app')

@section('content')
    <h2>La règle {{ $rule->name }} </h2>
    <form method="post" action="{{ $rule->editLink() }}">
        @csrf
        @method('patch')
        <label for="description">Description de la règle</label>
        <input type="text" class="form-control" name="description" value="{{ $rule->description }}">
        <fieldset class="d-flex flex-column">
            <legend>Roles concerné</legend>
            <table class="table">
                <col style="width:40%">
                <col style="width:50%">
                <col style="width:10%">
                <thead>
                    <tr>
                        <th>roles</th>
                        <th>personnes affectés</th>
                        <th>accordé?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td><label for="roles[]">{{ $role->name }}</label></td>
                            <td>{{ $role->users()->count() }}</td>
                            <td>
                                @if($rule->roles->contains($role))
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" checked>
                                    </div>
                                @else
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}">
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </fieldset>
        <input type="submit" class="btn btn-success" value="mettre à jour">
    </form>
@endsection