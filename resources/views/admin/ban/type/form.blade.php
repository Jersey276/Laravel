@extends('layouts.app')

@section('content')
    <form method="POST" action="{{isset($type) ? $type->id : ''}}">
        @csrf
        @if (isset($type))
            @method('PUT')
        @else
            @method('POST')
        @endif
        <label for="name">Nom</label>
        <input type="text" class="form-control" name="name" value={{isset($type)?$type->name:''}}>
        <label for="slug">Courte description</label>
        <input type="text" class="form-control" name="slug" value="{{isset($type)?$type->slug:''}}">
        <label for="description">description</label>
        <textarea class="form-control" name="description">
            {{isset($type)?$type->description:''}}
        </textarea>
        <label for="isDefinitive">Ban définitif</label>
        <input type="checkbox" class="form-Control" name="isDefinitive">
        <fieldset>
            <legend>
                Durée du banissement
            </legend>
            <div class="input-group mb-3">
            <label for="month" class="input-group-text">mois</label>
            <input class="form-control" type="number" min="0" max="12" name="month" value={{isset($time)? intval($time['month']):0}}>
            <label for="day" class="input-group-text">jour</label>
            <input class="form-control" type="number" min="0" max="30" name="day" value={{isset($time)?intval($time['month']):0}}>
            <label for="hour" class="input-group-text">heures</label>
            <input class="form-control" type="number" min="0" max="23" name="hour" value={{isset($time)?intval($time['hour']):0}}>
            <label for="minutes" class="input-group-text">minutes</label>
            <input class="form-control" type="number" min="0" max="59" name="minute" value={{isset($time)?intval($time['minute']):0}}>
            <label for="seconds" class="input-group-text">secondes</label>
            <input class="form-control" type="number" min="0" max="59" name="second" value={{isset($time)?intval($time['seconds']):0}}>
        </fieldset>
        <input type="submit" class="btn btn-success" value="Créer">
    </form>
@endsection