<?php

namespace App\Policies;

use App\Managers\RuleManager;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     * @param \App\Models\User $user
     * @param \App\Models\Project $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Project $post)
    {
        return RuleManager::checkRule('project_crud', $user) || $post->isVisible;
    }
}
