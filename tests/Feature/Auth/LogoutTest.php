<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }

    public function test_logout_success()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'email' => 'email@email.com',
            'password' => bcrypt('password'),
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson(route('v1.auth.logout'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_logout_failed()
    {
        $response = $this->postJson(route('v1.auth.logout'));

        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_logout_failed_with_invalid_token()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->faker->uuid,
        ])->postJson(route('v1.auth.logout'));

        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
