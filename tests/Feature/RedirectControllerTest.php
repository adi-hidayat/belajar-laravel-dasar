<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRedirect()
    {
        $this->get('/redirect/from')
                ->assertRedirect('/redirect/to');
    }

    public function testRedirectToNamedRoutes()
    {
        $this->get('/redirect/name')
                ->assertRedirectToRoute('redirect-hello', ['name' => 'Adi Ganteng']);
    }

    public function testRedirectAction()
    {
        $this->get('/redirect/action')
                ->assertRedirectToRoute('redirect-hello', ['name' => 'Adi Ganteng']);
    }

    public function testRedirectAway()
    {
        $this->get('/redirect/away')
                ->assertRedirect('https://www.google.com');
    }
}

