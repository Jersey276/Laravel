<div class="offcanvas offcanvas-start" id="adminOffCanvas">
    <div class="offcanvas-header">
        <h2>Admin</h2>
    </div>
    <div class="offcanvas-body w-100 h-100 px-0">
        <div class="accordion px-0" id="admin-offcanvas-accordion">
            @if (Auth::user()->rules('user_admin'))
                <div class="accordion-item">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="false" aria-controls="user-collapse"> 
                        Utilisateur
                    </button>
                    <ul id="user-collapse" class="accordion-collapse collapse list-group-flush mb-0" data-bs-parent="#admin-offcanvas-accordion">
                        <li class="list-group-item">
                            <a class="link-dark" href="/admin/users">Lister les utilisateurs</a>
                        </li>
                    </ul>
                </div>
            @endif
            @if (Auth::user()->rules('post_crud'))
                <div class="accordion-item">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#post-collapse"  aria-expanded="false" aria-controls="post-collapse"> 
                        Articles
                    </button>
                    <ul id="post-collapse" class="accordion-collapse collapse list-group-flush mb-0"  data-bs-parent="#admin-offcanvas-accordion">
                        <li class="list-group-item">
                            <a class="link-dark" href="/admin/posts">Lister les articles</a>
                        </li>
                        <li class="list-group-item">
                            <a class="link-dark" href="/admin/posts/add">Créer un article</a>
                        </li>
                    </ul>
                </div>
            @endif
            @if (Auth::user()->rules('project_crud'))
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#project-collapse"  aria-expanded="false" aria-controls="project-collapse">
                    Projets
                </button>
                <ul id="project-collapse" class="accordion-collapse collapse list-group-flush mb-0"  data-bs-parent="#admin-offcanvas-accordion">
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/projects">Lister les projets</a>
                    </li>
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/projects/add">Créer un projet</a>
                    </li>
                </ul>
            </div>
            @endif
            @if(Auth::user()->rules('cv_crud'))
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cv-collapse"  aria-expanded="false" aria-controls="cv-collapse">
                    CV
                </button>
                <ul id="cv-collapse" class="accordion-collapse collapse list-group-flush mb-0"  data-bs-parent="#admin-offcanvas-accordion">
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/cv">Gérer les éléments du cv</a>
                    </li>
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/cv/exp">Gérer les expériences</a>
                    </li>
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/cv/knowledge">Gérer les compétences</a>
                    </li>
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/cv/courses">Gérer les formations</a>
                    </li>
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/cv/languages">Gérer les langues</a>
                    </li>
                </ul>
            </div>
            @endif
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#admin-collapse"  aria-expanded="false" aria-controls="admin-collapse"> 
                    Options d'administrations
                </button>
                <ul id="admin-collapse" class="accordion-collapse collapse list-group-flush mb-0"  data-bs-parent="#admin-offcanvas-accordion">
                    @if(Auth::user()->rules('moderation'))
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/log">gérer les journaux</a>
                    </li>
                    @endif
                    @if(Auth::user()->rules('moderation'))
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/users/banlist">Lister les utilisateurs bannis</a>
                    </li>
                    @endif
                    @if(Auth::user()->rules('roles_crud'))
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/roles">Lister les roles</a>
                    </li>
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/roles/add">Ajouter un role</a>
                    </li>
                    @endif
                    @if(Auth::user()->rules('rules_admin'))
                    <li class="list-group-item">
                        <a class="link-dark" href="/admin/rules">Lister les règles</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>