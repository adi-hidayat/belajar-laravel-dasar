<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testResponse()
    {
        $this->get('/response')->assertStatus(200)->assertSeeText("Hello Response");
    }

    public function testResponseWithHeader()
    {
        $this->get('/header')->assertStatus(200)
                             ->assertSeeText('Adi')->assertSeeText('Hidayat')
                             ->assertHeader('Content-Type', 'application/json')
                             ->assertHeader('Author', 'Adi Hidayat')
                             ->assertHeader('App', 'Belajar Laravel');
    }

    public function testView()
    {
        $this->get('/responseview')->assertSeeText('Hello Adi');
    }

    public function testJson()
    {
        $this->get('/responsejson')->assertJson(['firstName' => "Adi", 'lastName' => "Hidayat"]);
    }

    public function testFile()
    {
        $this->get('/responsefile')->assertHeader('Content-Type', 'image/png');
    }

    public function testDownload()
    {
        $this->get('/responsedownload')->assertDownload('AdiGanteng.png');
    }

    
}
