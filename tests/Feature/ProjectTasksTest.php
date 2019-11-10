<?php

namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();

        $this->post($project->path().'/tasks')->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->post($project->path().'/tasks', ['body' => 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_tasks()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks[0]->path(), ['body' => 'changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        // $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path().'/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        // $project = app(ProjectFactory::class)
        //     ->ownedBy($this->signIn())
        //     ->withTasks(1)
        //     ->create();

        // Add "Facades/" before the import, and u can use the method staticly
        $project = ProjectFactory::withTasks(1)->create();

        $this
            ->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'changed',
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
        ]);
    }

    /** @test */
    public function a_task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this
            ->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'changed',
                'completed' => true,
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true,
        ]);
    }

    /** @test */
    public function a_task_can_marked_as_incomplete()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this
            ->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'changed',
                'completed' => true,
            ]);

        $this
            ->patch($project->tasks[0]->path(), [
                'body' => 'changed',
                'completed' => false,
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false,
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::create();

        $attribute = factory('App\Task')->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path().'/tasks', $attribute)
            ->assertSessionHasErrors('body');
    }
}
