<?php

use Tests\Feature\FeatureTestCase;

class LoginTest extends FeatureTestCase
{
    public function testEmailAndPasswordRequired()
    {
        $response = $this->postJson('/auth/login');

        $response->assertJsonValidationErrors(['email', 'password']);
    }

    public function testCanLogin()
    {
        factory(\App\Domain\Auth\Models\User::class)->create([
            'email'    => 'test@test.com',
            'password' => bcrypt('secret'),
        ]);

        $response = $this->postJson('/auth/login', [
            'email'    => 'test@test.com',
            'password' => 'secret',
        ]);

        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'csrf',
        ]);

        $response->assertCookie('laravel_token');
        $response->assertCookie('XSRF-TOKEN');
    }
}