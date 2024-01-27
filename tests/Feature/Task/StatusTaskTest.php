<?php

namespace Tests\Feature\Task;

use App\Models\StatusTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusTaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_status_task()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->seed();

        Task::factory()->create([
            'user_id' => $user->id,
            'status_task_id' => StatusTask::all()->random()->id
        ]);

        $response = $this->actingAs($user, 'api')->patchJson(route('v1.task.status.update'), [
            'id' => $user->tasks()->first()->id,
            'status_task_id' => StatusTask::all()->random()->id
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Task status updated'
        ]);
    }

    public function test_task_status_validate()
    {
        $user = User::factory()->create();
        $this->seed();

        Task::factory()->create([
            'user_id' => $user->id,
            'status_task_id' => StatusTask::all()->random()->id
        ]);

        $response = $this->actingAs($user, 'api')->patchJson(route('v1.task.status.update'), [
            'id' => $user->tasks()->first()->id,
            'status_task_id' => 999
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'status_task_id'
            ]
        ]);
    }

    public function test_task_validate()
    {
        $user = User::factory()->create();
        $this->seed();

        Task::factory()->create([
            'user_id' => $user->id,
            'status_task_id' => StatusTask::all()->random()->id
        ]);

        $response = $this->actingAs($user, 'api')->patchJson(route('v1.task.status.update'), [
            'id' => 999,
            'status_task_id' => StatusTask::all()->random()->id
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'id'
            ]
        ]);
    }

    public function test_task_unauthorized()
    {
        $user = User::factory()->create();
        $this->seed();

        Task::factory()->create([
            'user_id' => $user->id,
            'status_task_id' => StatusTask::all()->random()->id
        ]);

        $response = $this->patchJson(route('v1.task.status.update'), [
            'id' => $user->tasks()->first()->id,
            'status_task_id' => StatusTask::all()->random()->id
        ]);

        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
