<?php

namespace Tests\Feature\Task;

use App\Models\Priority;
use App\Models\StatusTask;
use App\Models\Task;
use App\Models\TypeTask;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_should_update_a_task()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->seed();
        Task::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'api')->putJson(route(
            'v1.task.update',
            Task::where('user_id', $user->id)->first()->id
        ), [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority_id' => Priority::all()->random()->id,
            'type_task_id' => TypeTask::all()->random()->id,
            'status_task_id' => StatusTask::all()->random()->id,
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_it_should_not_update_a_task_when_not_authenticated()
    {
        $this->seed();
        Task::factory()->create();

        $response = $this->putJson(route(
            'v1.task.update',
            Task::first()->id
        ), [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority_id' => Priority::all()->random()->id,
            'type_task_id' => TypeTask::all()->random()->id,
            'status_task_id' => StatusTask::all()->random()->id,
        ]);

        $response->assertUnauthorized();
    }

    public function test_it_should_not_update_a_task_when_not_found()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->seed();
        Task::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'api')->putJson(route(
            'v1.task.update',
            Task::where('user_id', $user->id)->first()->id + 1000
        ), [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority_id' => Priority::all()->random()->id,
            'type_task_id' => TypeTask::all()->random()->id,
            'status_task_id' => StatusTask::all()->random()->id,
        ]);

        $response->assertNotFound();
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_it_should_not_update_a_task_when_validation_fails()
    {
        $user = User::factory()->create();
        $this->seed();
        Task::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'api')->putJson(route(
            'v1.task.update',
            Task::where('user_id', $user->id)->first()->id
        ), [
            'title' => '',
            'description' => $this->faker->paragraph,
            'priority_id' => '',
            'type_task_id' => '',
            'status_task_id' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }
}
