<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_delete_task()
    {
        $this->withoutExceptionHandling();

        $this->seed();
        Task::factory()->create();

        $user = User::whereHas('tasks')->first();
        $task_id = $user->tasks->first()->id;

        $response = $this->actingAs($user, 'api')->deleteJson(route('v1.task.delete', ['id' => $task_id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_delete_task_not_found()
    {
        $this->withoutExceptionHandling();

        $this->seed();
        Task::factory()->create();

        $user = User::whereHas('tasks')->first();
        $task_id = $user->tasks->first()->id + 1000;

        $response = $this->actingAs($user, 'api')->deleteJson(route('v1.task.delete', ['id' => $task_id]));

        $response->assertNotFound();
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_delete_task_unauthorized()
    {

        $this->seed();
        Task::factory()->create();

        $response = $this->deleteJson(route('v1.task.delete', ['id' => 1]));

        $response->assertUnauthorized();
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
