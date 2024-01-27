<?php

namespace Tests\Feature\Priority;

use App\Models\Priority;
use App\Models\User;
use Database\Factories\PriorityFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriorityAllTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_priority_all_successfully()
    {
        $user = User::factory()->create();
        Priority::factory(3)->create();
        // dd(Priority::all()->toArray());

        $response = $this->actingAs(
            $user,
            'api'
        )->getJson(route('v1.priorities.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'is_active',
            ],
        ]);
    }

    public function test_priority_all_without_priorities_in_database()
    {
        $user = User::factory()->create();

        $response = $this->actingAs(
            $user,
            'api'
        )->getJson(route('v1.priorities.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    public function test_priority_all_unauthenticated()
    {
        $response = $this->getJson(route('v1.priorities.index'));

        $response->assertUnauthorized();
    }
}
