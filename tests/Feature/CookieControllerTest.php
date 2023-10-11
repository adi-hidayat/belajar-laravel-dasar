<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateCookie()
    {
        $this->get('/cookie')
                ->assertCookie('User-ID', 'Adi')
                ->assertCookie('User-Member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookie('User-ID', 'Adi')
                ->withCookie('User-Member', 'true')
                ->get('/getcookie')
                ->assertJson([
                    'UserID' => 'Adi',
                    'UserMember' => 'true'
                ]);
    }
}
