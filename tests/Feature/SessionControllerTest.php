<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSession()
    {
        $this->get('/session/create')
                ->assertSeeText('OK')
                ->assertSessionHas('userName', 'JackSparrow')
                ->assertSessionHas('position', 'captain');
    }
    
    public function testGetSession()
    {
        $this->withSession([
            'userName' => 'JackSparrow',
            'position' => 'captain'
        ])->get('/session/get')->assertSeeText('JackSparrow');    
    }

    public function testRemoveSession()
    {
        $this->get('/session/remove')
                ->assertSeeText("OK")
                ->assertSessionMissing('userName')
                ->assertSessionMissing('position');
    }

    
}
