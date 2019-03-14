<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_invite_a_user()
    {
        // Give I have a project
        $project = ProjectFactory::create();

        // And the owner of the project invites another user
        $project->invite($anotherUser = factory(\App\User::class)->create());

        // Then, that new user will have permission to add tasks
    }
}
