<div class="list-group-item">
    Banni par <a class="link link-dark" href="{{url($ban->judge->displayLink())}}">{{$ban->judge->name}}</a> le {{date_format(new Datetime($ban->startedAt), 'd/m/Y à h:i:s')}}
    <h2>Motif : {{$ban->bantype->name}}</h2>
    <p class="mb-3">
        {{$ban->bantype->description}}
    </p>
    <h4>commentaire :</h4>
    <p class="border rounded">
        {{$ban->commentary !== ""?$ban->commentary:"aucun commentaire"}}
    </p>
</div>