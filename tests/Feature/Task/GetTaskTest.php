<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_get_task()
    {
        $this->withoutExceptionHandling();

        $this->seed();
        Task::factory()->create();

        $user = User::whereHas('tasks')->first();
        $task_id = $user->tasks->first()->id;

        $response = $this->actingAs($user, 'api')->getJson(route('v1.task.get', ['id' => $task_id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'title',
            'description',
            'priority',
            'type_task',
            'status_task',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_get_task_not_found()
    {
        $this->withoutExceptionHandling();

        $this->seed();
        Task::factory()->create();

        $user = User::whereHas('tasks')->first();
        $task_id = $user->tasks->first()->id + 1000;

        $response = $this->actingAs($user, 'api')->getJson(route('v1.task.get', ['id' => $task_id]));

        $response->assertNotFound();
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_get_task_unauthenticated()
    {
        $this->seed();
        Task::factory()->create();

        $response = $this->getJson(route('v1.task.get', ['id' => 1]));

        $response->assertUnauthorized();
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
