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
        @include('admin.users.card')
    @endforeach
    </tbody>
</table>
@endsection