@extends('layouts.mail')

@section('content')
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td class="table-info">Name</tb>
                <td>{{$contact->name}}</tb>
                <td class="table-info">Compagnie</tb>
                <td>{{isset($contact->company)?$contact->company: "sans compagnie"}}</tb>
            </tr>
            <tr>
                <td colspan="2" class="table-info">Email</tb>
                <td colspan="2">{{$contact->email}}</tb>
            </tr>
            <tr>
                <td colspan="4"><p>{!! nl2br($contact->message) !!}<p></tb>
            </tr>
        </tbody>
    </table>
@endsection