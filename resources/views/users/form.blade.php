@extends('layouts/app')

@section('content')

    <h1> Mise à jour de votre profil </h1>

    <div class="d-flex flex-row justify-content-between mb-3">
        @if ($user->avatar)
            <img class="rounded-circle" src="{{asset('storage/avatar/'. $user->avatar)}}" style="width:150px;height:150px;">
        @else
            <img class="rounded-circle" src="{{asset('storage/avatar/default.png')}}" style="width:150px;height:150px;">
        @endif
        <form class="align-self-end" method="POST" action="avatar" id="avatarForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-group">
                <input class="form-control" type="file" name="avatar">
                <button class="btn btn-success" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <form method="POST" action="">
        @csrf
        @method('PUT')
        
        <div class="alert alert-warning" role="alert">
            <h2>Changer son adresse mail</h2>
            <strong>En cas de changement, le compte devra être vérifié de nouveau. Un email sera envoyé pour vérification</strong>
            <input name="email" class="form-control" placeholder="" value="{{$user? $user->email: ''}}">
        </div>


        <div class="form-group mb-3">
            <textarea name="biography" class="form-control" placeholder="parlez-nous un peu de vous">
                {{$user ? $user->biography : ''}}
            </textarea>
        </div>
        <input type="submit" class="btn btn-success">
    </form>
    <script>
        function changeAvatar() {
            document.getElementById('avatarForm').submit()
        }
    </script>
@endsection
