<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFullUrl()
    {
       $this->get('/url/current?name=Adi')->assertSeeText('/url/current?name=Adi');
    }

    public function testNamedGeneration()
    {
        $this->get('/url/named')->assertSeeText('/redirect/name/Adi');
    }

    public function testControllerAction()
    {
        $this->get('/url/action')->assertSeeText('/csrf');
    }
}
