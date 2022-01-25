@extends('layouts.app')

@section('content')
<div class="accordion" id="accordionExample">
    @foreach ($bans as $ban)  
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{$ban->id}}">
                <button class="accordion-button text-dark fw-bolder bg-{{$ban->isActive?'danger bg-opacity-75':'secondary bg-opacity-10'}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$ban->id}}" aria-expanded="true" aria-controls="collapse{{$ban->id}}">
                Ban du {{date_format(new Datetime($ban->startedAt), 'D d F Y h:i:s')}}{{ isset($ban->endedAt) ?" au ".date_format(new Datetime($ban->endedAt), 'D d F Y h:i:s'):''}}
                </button>
            </h2>
            <div id="collapse{{$ban->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$ban->id}}" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <h3>Juge : {{$ban->judge->name}}</h3>
                    <h4> raison du banissement : {{$ban->bantype->name}} </h4>
                    <p>
                        {{$ban->bantype->description}}<br>
                        durée : {{isset($ban->bantype->duration)?$ban->bantype->duration:__('definitif')}}
                    </p>
                </div>
                <div class="accordion-footer d-flex flex-row py-3 px-3 border-top">
                    @if ($ban->isActive)
                        <form method="post" action="{{ $ban->unbanLink(true) }}">
                            @csrf
                            @method('put')
                            <button type="submit" class="link-warning border-0 bg-transparent" value="Supprimer"  data-bs-toggle="tooltip" data-bs-placement="top"  title="{{__('Désactiver le ban')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hammer" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                    <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5.009 5.009 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334z"/>
                                </svg>
                            </button>
                        </form>
                    @else
                        <button type="submit" class="link-secondary border-0 bg-transparent" disabled value="Supprimer"  data-bs-toggle="tooltip" data-bs-placement="top"  title="{{__('Le ban est déja inactif')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hammer" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5.009 5.009 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334z"/>
                            </svg>
                        </button>
                    @endif
                    <form method="post" action="{{ $ban->unbanLink(true) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="link-danger border-0 bg-transparent" value="Supprimer"  data-bs-toggle="tooltip" data-bs-placement="top"  title="{{__('Supprimer le ban')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection