<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" id="adminOffCanvas">
    <div class="offcanvas-header">
        <h2>Admin</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <div class="accordion px-0" id="admin-offcanvas-accordion">
            @foreach ($panelRoutes as $panelKey => $panel)
                @if (empty($panel->rules) || Auth::user()->rules($panel->rules))
                    <div class="accordion-item">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{$panelKey}}-collapse" aria-expanded="false" aria-controls="admin-collapse">
                            {{__($panel->name)}}
                        </button>
                        <ul id="{{$panelKey}}-collapse" class="accordion-collapse collapse list-group-flush mb-0" data-bs-parent="#admin-offcanvas-accordion">
                            @foreach ($panel->links as $link)
                                @if (empty($link->rules) || Auth::user()->rules($link->rules))
                                    <li class="list-group-item">
                                        <a class="link-dark" href="{{$link->links}}">{{__($link->name)}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>