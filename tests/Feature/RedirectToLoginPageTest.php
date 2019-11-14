<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectToLoginPageTest extends TestCase
{
    public function testRedirectUnathorizedFromIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    public function testRedirectUnathorizedFromDashboard()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302);
    }

    public function testRedirectUnathorizedFromUser()
    {
        $response = $this->get('/user');
        $response->assertStatus(302);
    }

    public function testRedirectUnathorizedFromClient()
    {
        $response = $this->get('/client');
        $response->assertStatus(302);
    }
}
