<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, Project $project)
    {
        return $user->is($project->owner);
    }

    public function update(User $user, Project $project)
    {
        // is() check if two models are the same by looking at the id
        return $user->is($project->owner) || $project->members->contains($user);
    }
}
