<?php

namespace Tests\Feature\Status;

use App\Models\StatusTask;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusAllTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_all_status()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        StatusTask::factory()->count(4)->create();

        $response = $this->actingAs($user, 'api')->getJson(route('v1.status.all'));

        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'is_active',
            ]
        ]);
    }

    public function test_without_status_in_database()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->getJson(route('v1.status.all'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    public function test_all_status_unauthenticated()
    {
        $response = $this->getJson(route('v1.status.all'));

        $response->assertUnauthorized();
    }
}
