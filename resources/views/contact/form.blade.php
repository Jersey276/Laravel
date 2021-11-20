@extends('layouts.app')

@section('content')
    <form method="POST" action="/contact">
        @csrf
        <div class="d-flex flex-row justify-content-between mb-3">
            <div class="form-floating w-100 me-3">
                <input type="text" class="form-control" name="name" placeholder="name">
                <label class="form-label" for="name">Nom</label>
            </div>
            <div class="form-floating w-100 ms-3">
                <input type="text" class="form-control" name="company" placeholder="company">
                <label class="form-label" for="company">Companie (optionnel)</label>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" placeholder="email">
            <label class="form-label" for="email">Email</label>
        </div>
        <div class="form-floating mb-3">
            <textarea name="message" class="form-control" placeholder="message" style="height: 25vh"></textarea>
            <label class="form-label" for="message">Message</label>
        </div>
        <input type="submit" class="ml-auto btn btn-success"/>
    </form>
@endsection