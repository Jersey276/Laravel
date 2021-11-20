@extends('layouts.app')

@section('content')
    <div class="accordion" id="contact-accordion">
        @if (count($contacts) > 0)
            @foreach ($contacts as $contact)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{$contact->id}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$contact->id}}" aria-expanded="false" aria-controls="collapse{{$contact->id}}">
                        {{$contact->name}} - {{isset($contact->company)?$contact->company: "sans compagnie"}} - {{$contact->created_at}}
                    </button>
                    </h2>
                    <div id="collapse{{$contact->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$contact->id}}" data-bs-parent="#contact-accordion">
                        <div class="accordion-body">
                            {{$contact->message}}
                            <hr>
                            <a class="btn btn-success" href="mailto:{{$contact->email}}">{{__('Répondre')}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            Le formulaire de contact n'a pas encore été utilisé
        @endif
    </div>
@endsection