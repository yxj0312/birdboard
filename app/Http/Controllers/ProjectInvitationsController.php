<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project)
    {
        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);
    }
}
