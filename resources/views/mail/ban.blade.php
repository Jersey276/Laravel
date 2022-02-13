@extends('layouts.mail')

@section('content')
    <div class="alert alert-danger text-center">
        <h1>Votre compte à été banni du site</h1>
        <div>
            Banni par {{$ban->judge->name}} le {{$ban->startedAt->format('d/m/Y à h:i:s')}}
            <h2>Motif : {{$ban->bantype->name}}</h2>
            <p class="mb-3">
                {{$ban->bantype->description}}
            </p>
            <h4>commentaire :</h4>
            <p class="border rounded">
                {{$ban->commentary}}
            </p>
            <a href="{{url('/contact')}}" class="btn btn-danger">
                contester le ban
            </a>
        </div>
        
    </div>
@endsection