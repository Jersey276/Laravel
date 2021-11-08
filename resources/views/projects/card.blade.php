<div class="card px-0">
    <img class="card-img-top" src="{{ asset('img/profile.webp')}}">
    <div class="card-body">
        <h2 class="card-title">{{ $project->title }}</h2>
        <p class="card-text">{{ $project->slug }}</p>
    </div>
    <div class="card-footer">
        <a class="btn btn-outline-primary" href="{{$project->displayLink()}}">plus de détail</a>
    </div>
</div>