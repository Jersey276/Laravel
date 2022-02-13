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
        <th scope="col">ban actifs</th>
        <th scope="col">nb total ban</th>
        <th scpre="col">action</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        @include('admin.ban.banned.card')
    @endforeach
    </tbody>
</table>
@endsection