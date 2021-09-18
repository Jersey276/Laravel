@extends('layouts/app')

@section('content')
<h1>Règles du site</h1>
<table class="table">
    <col style="width:15%">
    <col style="width:65%">
    <col style="width:20%">
    <thead>
        <tr>
            <th>nom</th>
            <th>description</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($rules as $rule)
        <tr>
            <td>{{ $rule->name }}</td>
            <td>{{ $rule->description }}</td>
            <td><a class="btn btn-info" href="{{ $rule->editLink() }}">affecter</a></td>
        </div>
    @endforeach
    </tbody>
</table>
@endsection