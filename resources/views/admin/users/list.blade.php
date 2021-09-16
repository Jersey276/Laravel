@extends('layouts/app')

@section('content')
<table class="table">
    <col style="width:5%">
    <col style="width:25%">
    <col style="width:25%">
    <col style="width:25%">
    <col style="width:20%">
    <thead>
        <th scope="col">#</th>
        <th scope="col">pseudo</th>
        <th scope="col">email</th>
        <th scope="col">role</th>
        <th scpre="col">action</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id}}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name }}</td>
            <td><a class="btn btn-warning" href="{{ $user->adminEditLink() }}">modifier</a></td>
        </tr>
    @endforeach
</div>
@endsection