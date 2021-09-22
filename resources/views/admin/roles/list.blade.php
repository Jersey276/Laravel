@extends('layouts/app')

@section('content')
    <a class="btn btn-success" href="/admin/roles/add">Nouveau roles</a>
    @if (count($roles) == 0)
    <div class="alert alert-danger">
        Aucun role de base a été crée
        <form method="post" action="/admin/roles/add">
            @csrf
            <input type="hidden" name="name" value="user">
            <input type="submit" class="btn btn-danger" value="Nouveau Role">
        </form>
    </div>
    @else
        <table class="table">
            <col style="width:10%">
            <col style="width:60%">
            <col style="width:30%">
            <thead>
                <tr>
                    <th scope="col">name</th>
                    <th scope="col">roles parents</th>
                    <th scole="col">actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>
                            {{ $role->name }}
                        </td>
                        <td class="">
                            @if(json_decode($role->parents) != null)
                                {{ implode(', ', json_decode($role->parents) )}}
                            @endif
                        </td>
                        <td class="d-flex flex-row">
                            <a class="btn btn-warning" href="{{$role->editLink()}}">Modifier</a>
                            <form method="post" action="{{ $role->editLink() }}">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Supprimer">
                            </form>
                        </td>
                    </div>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection