<?php

namespace Tests\Feature\Task;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AllTaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_get_all_task()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->getJson(route('v1.task.all'));

        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'description',
                'priority',
                'type_task',
                'status_task',
                'created_at',
                'updated_at',
            ]
        ]);
    }

    public function test_without_task_in_database()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->getJson(route('v1.task.all'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    public function test_all_task_unauthenticated()
    {
        $response = $this->getJson(route('v1.task.all'));

        $response->assertUnauthorized();
    }
}
