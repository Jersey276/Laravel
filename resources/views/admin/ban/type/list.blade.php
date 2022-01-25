@extends('layouts.app')

@section('content')
<div class="accordion" id="banTypeAccordion">
    @foreach ($bansTypes as $type)
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{$type->id}}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$type->id}}" aria-expanded="true" aria-controls="collapse{{$type->id}}">
                {{$type->name}}
            </button>
        </h2>
        <div id="collapse{{$type->id}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$type->id}}" data-bs-parent="#banTypeAccordion">
            <div class="accordion-body">
                {{$type->description}}<br>
                <hr>
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        @if($type->isDefinitive)
                            {{ __('Definitive') }}
                        @else
                            {{$type->duration}}
                        @endif
                    </div>
                    <div class="d-flex flex-row">
                        <a href="{{$type->editLink()}}" class="text-warning"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Modifier le type de ban')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a>
                        <form method="post" action="{{ $type->editLink() }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Supprimer le type de ban')}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="link-danger border-0 bg-transparent" value="Supprimer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    @endforeach
</div>
@endsection