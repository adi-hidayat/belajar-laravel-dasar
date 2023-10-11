<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RequestControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRequest()
    {
        $this->get('/request', ['Accept' => 'plain/text'])
            ->assertSeeText('request')
            ->assertSeeText('http://localhost/request')
            ->assertSeeText('GET')
            ->assertSeeText('plain/text');
    }
}
