<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInvalid()
    {
        $response = $this->get('/middleware/api');

        $response->assertStatus(401)->assertSeeText("Access denied");
    }

    public function testValid()
    {
        $this->withHeader('X-API-KEY', 'KEY123')
                ->get('/middleware/api')
                ->assertStatus(200)
                ->assertSeeText('OK');
    }
}
