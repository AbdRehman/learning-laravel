<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $payload = [
            'user' => $this->faker->name, 
            'email' => $this->faker->email, 
            'password' => 'abca9s8dj204rj'
        ];
        $res = $this->post('/custom-registration', $payload);
        $res->assertRedirect();
    }
}
