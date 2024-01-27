<?php

namespace Tests\Feature\Task;

use App\Models\Priority;
use App\Models\StatusTask;
use App\Models\TypeTask;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_store_task()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->seed();

        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority_id' => Priority::all()->random()->id,
            'type_task_id' => TypeTask::all()->random()->id,
            'status_task_id' => StatusTask::all()->random()->id,
        ];

        $response = $this->actingAs($user, 'api')->postJson(route('v1.task.store'), $data);

        $response->assertCreated();
        $response->assertJson([
            'message' => 'Task created successfully',
        ]);
    }

    public function test_store_task_unauthorized()
    {
        $this->seed();

        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority_id' => Priority::all()->random()->id,
            'type_task_id' => TypeTask::all()->random()->id,
            'status_task_id' => StatusTask::all()->random()->id,
        ];

        $response = $this->postJson(route('v1.task.store'), $data);

        $response->assertUnauthorized();
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_store_task_validation_errors()
    {
        $user = User::factory()->create();
        $this->seed();

        $data = [
            'title' => '',
            'description' => '',
            'priority_id' => '',
            'type_task_id' => '',
            'status_task_id' => '',
        ];

        $response = $this->actingAs($user, 'api')->postJson(route('v1.task.store'), $data);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'title',
                'priority_id',
                'type_task_id',
                'status_task_id',
            ],
        ]);
    }
}
