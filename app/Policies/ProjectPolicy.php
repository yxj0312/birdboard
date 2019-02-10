<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Project $project)
    {
        // is() check if two models are the same by looking at the id
        return $user->is($project->owner);
    }
}
