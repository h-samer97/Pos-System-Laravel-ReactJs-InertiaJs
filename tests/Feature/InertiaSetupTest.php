<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InertiaSetupTest extends TestCase
{
    public function test_home_page_uses_inertia(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertHeader('X-Inertia', 'true')
            ->assertJsonPath('component', 'Home');
    }
}
