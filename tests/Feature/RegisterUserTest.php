<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }
    /**
     * test when user register
     */
    public function test_register_user(): void
    {
        $response = $this->postJson(route('v1.auth.register'), [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertStatus(201);
    }

    /**
     * test when user register with invalid data
     */
    public function test_register_user_with_invalid_data(): void
    {
        $response = $this->postJson(route('v1.auth.register'), [
            'name' => 'test',
            'email' => '',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors'
        ]);
    }
}
