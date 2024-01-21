<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerifyUserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }
    /**
     * test verify code user
     */
    public function test_verify_code_user(): void
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'verification_code' => $this->faker->randomNumber(6),
            'password' => '12345678'
        ]);

        $code = $user->verification_code;

        $response = $this->getJson(route('v1.auth.verify', $code));

        $response->assertStatus(200);
    }

    /**
     * test verify code user with invalid code
     */
    public function test_invalid_verify_code_user(): void
    {
        User::factory(1)->create();

        $response = $this->getJson(route('v1.auth.verify', 123456));

        $response->assertStatus(400);
    }
}
