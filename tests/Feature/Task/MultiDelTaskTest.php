<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MultiDelTaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_multi_del_task()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->seed();

        Task::factory()->count(5)->create([
            'user_id' => $user->id,
        ]);

        $ids = Task::where('user_id', $user->id)->pluck('id')->toArray();

        $response = $this->actingAs($user, 'api')->postJson(route('v1.task.multi-del'), [
            'ids' => $ids,
        ]);

        $response->assertOk();
        $response->assertJson([
            'message' => 'Tasks deleted successfully',
        ]);
    }

    public function test_multi_del_task_unauthorized()
    {
        $this->seed();

        $ids = Task::all()->pluck('id')->toArray();

        $response = $this->postJson(route('v1.task.multi-del'), [
            'ids' => $ids,
        ]);

        $response->assertUnauthorized();
    }

    public function test_multi_del_valid_array()
    {
        $this->seed();

        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->postJson(route('v1.task.multi-del'), [
            'ids' => 'invalid',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'ids',
        ]);
    }

    public function test_multi_del_task_validation_ids_param()
    {
        $this->seed();

        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->postJson(route('v1.task.multi-del'), [
            'ids' => [],
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'ids',
        ]);
    }

    public function test_multi_del_task_validation_ids_exists()
    {
        $this->seed();

        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->postJson(route('v1.task.multi-del'), [
            'ids' => [9999],
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'ids.0',
        ]);
    }
}
