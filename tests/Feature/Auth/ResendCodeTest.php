<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResendCodeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }

    /**
     * test resend code user
     */
    public function test_resend_code_user(): void
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'verification_code' => $this->faker->randomNumber(6),
            'password' => '12345678'
        ]);

        $response = $this->postJson(route('v1.auth.resend-code'), [
            'email' => $user->email
        ]);

        $response->assertStatus(200);
    }

    /**
     * test resend code user with invalid email
     */
    public function test_resend_code_user_with_invalid_email(): void
    {
        User::factory(1)->create();

        $response = $this->postJson(route('v1.auth.resend-code'), [
            'email' => 'email@email.com'
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors'
        ]);
    }

    /**
     * test resend code user with verified email
     */
    public function test_resend_code_user_with_verified_email(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now()
        ]);

        $response = $this->postJson(route('v1.auth.resend-code'), [
            'email' => $user->email
        ]);

        $response->assertStatus(400);
    }
}
