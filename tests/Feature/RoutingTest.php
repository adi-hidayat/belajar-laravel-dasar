<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetGanteng()
    {
//        $response = $this->get('/ganteng');
//
//        $response->assertStatus(200);
        // atau bsia gunakan cara lebih keren :
        $this->get('/ganteng')->assertStatus(200)->assertSeeText("Hello adi ganteng");
    }

    public function testRedirect(){
        $this->get('/jelek')->assertRedirect('/ganteng');
    }

    public function testFallback()
    {
        $this->get('/ups')->assertSeeText('Gak ada route');
    }

    public function testRouteParameter(){
        $this->get('/products/1')->assertSeeText('Products : 1');
        $this->get('/products/1/items/1')->assertSeeText('Products : 1, Items : 1');
    }

    public function testRouteWithRegex()
    {
        $this->get('/categories/123')->assertSeeText('Categories : 123');
        $this->get('/categories/salah')->assertSeeText('404');
    }

    public function testRouteOptionalParameter()
    {
        $this->get('/users/123')->assertSeeText('Users : 123');
        $this->get('/users')->assertSeeText('Users : Guess');
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/adi')->assertSeeText("Search dengan Parameter Adi");
        $this->get('/conflict/adi')->assertSeeText("Search dengan Method Adi");
    }

    public function testNamed()
    {
        $this->get('/faktur/123')->assertSeeText('invoice/123');
        $this->get('/faktur-redirect/123')->assertRedirect('invoice/123');
    }
}
