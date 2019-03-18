<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_project_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $userToInvite = factory(User::class)->create();

        $this->actingAs($project->owner)->post($project->path().'/invitations', [
            'email' => $userToInvite->email
        ]); 

        $this->assertTrue($project->members->contain($userToInvite));   
    }

    /** @test */
    public function invited_users_may_update_project_details()
    {
        // Give I have a project
        $project = ProjectFactory::create();

        // And the owner of the project invites another user
        $project->invite($newUser = factory(\App\User::class)->create());

        // Then, that new user will have permission to add tasks
        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
