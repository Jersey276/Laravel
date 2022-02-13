@extends('layouts.mail')

@section('content')
    @if($isBanMail)
        <div class="alert alert-danger text-center">
            <h1>Votre compte à été banni du site</h1>
            @include('mail.card')
            <a href="{{url('/contact')}}" class="btn btn-danger">
                contester le ban
            </a>
        </div>
    @else
        <div class="alert alert-success text-center">
            @if(count($bans) === 0)
                <h1>un ban vous a été {{$isRemoved?'supprimé':'révoqué"'}}</h1>
                @include('mail.card')
            @else
                <h1>Vous avez été intégralement débannis par <a class="link-success" href="{{ url($judge->displayLink()) }}">{{ $judge->name }}</a></h1>
                <div class="alert alert-light">
                    <div class="list-group list-group-flush">
                        @each('mail.card', $bans, 'ban', 'mail.card')
                    </div>
            @endif
        </div>
    @endif
@endsection