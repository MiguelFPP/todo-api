<?php

namespace Tests\Feature\Types;

use App\Models\TypeTask;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TypesAllTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_all_types()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        TypeTask::factory()->count(4)->create();

        $response = $this->actingAs($user, 'api')->getJson(route('v1.types.all'));

        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'is_active',
            ]
        ]);
    }

    public function test_without_types_in_database()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->getJson(route('v1.types.all'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    public function test_all_types_unauthenticated()
    {
        $response = $this->getJson(route('v1.types.all'));

        $response->assertUnauthorized();
    }
}
