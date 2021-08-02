<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function register()
    {
        $num   = rand(100, 999);
        $name  = "user {$num}";
        $email = "email{$num}@sampleemail.com";
        
        $response = $this->post('/api/register', [
            'name'                  => $name,
            'email'                 => $email,
            'password'              => "password",
            'password_confirmation' => "password",
        ]);

        $response->assertJsonFragment(compact('name', 'email'));
    }

    /** @test **/
    public function login()
    {
        $name  = $this->user->name;
        $email = $this->user->email;
        
        $response = $this->post('/api/login', [
            'email'    => $email,
            'password' => "password",
        ]);

        $response->assertJsonFragment(compact('name', 'email'));
    }
}
