<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_wrong_mail_not_exists()
    {
        $response = $this->postJson('/api/auth/login', ['password' => '1234567890']);

        $response->assertStatus(422);
    }

    public function test_login_with_wrong_password_not_exists()
    {
        $response = $this->postJson('/api/auth/login', ['email' => 'aziz@albasyir.com']);

        $response->assertStatus(422);
    }

    public function test_login_with_wrong_mail_format()
    {
        $response = $this->postJson('/api/auth/login', ['email' => 'albasyir', 'password' => '1234567890']);

        $response->assertStatus(422);
    }

    public function test_login_with_wrong_password_format()
    {
        $response = $this->postJson('/api/auth/login', ['email' => 'aziz@albasyir.com', 'password' => '1234']);

        $response->assertStatus(422);
    }


    public function test_login_with_wrong_credentials()
    {
        $response = $this->postJson('/api/auth/login', ['email' => 'aziz@albasyir.com', 'password' => '1234567890']);

        $response->assertStatus(401);
    }

    public function test_login_with_fine_credentials()
    {

        User::create([
            'name' => 'Testing User',
            'email' => 'aziz@albasyir.com',
            'password' => 'testingpassword'
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'aziz@albasyir.com', 'password' => 'testingpassword'
        ]);

        $response->assertStatus(200);
    }

    public function test_logout_with_fine_condition()
    {
        $user = User::create([
            'name' => 'Testing User',
            'email' => 'aziz@albasyir.com',
            'password' => 'testingpassword'
        ]);

        // actingAs unsupport for this JWT, need override :-)
        $this->withHeader('Authorization', 'Bearer ' . JWTAuth::fromUser($user));

        $response = $this->postJson('/api/auth/logout');

        $response->assertStatus(204);
    }

    public function test_logout_without_login()
    {
        $response = $this->postJson('/api/auth/logout');

        $response->assertStatus(403);
    }

    public function test_register_with_wrong_mail_format()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'albasyir',
            'email' => 'aziz@',
            'password' => '12345678'
        ]);

        $response->assertStatus(422);
    }

    public function test_register_without_email()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'albasyir',
            'password' => '12345678'
        ]);

        $response->assertStatus(422);
    }

    public function test_register_without_name()
    {
        $response = $this->postJson('/api/auth/register', [
            'email' => 'aziz@',
            'password' => '12345678'
        ]);

        $response->assertStatus(422);
    }

    public function test_register_without_password()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'albasyir',
            'email' => 'aziz@albasyir.com'
        ]);

        $response->assertStatus(422);
    }


    public function test_register_with_fine_condition()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'albasyir',
            'email' => 'aziz@albasyir.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(201);
    }
}
