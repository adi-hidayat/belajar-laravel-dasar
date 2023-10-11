<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRequestInput()
    {
        $this->get('/input?name=Adi Ganteng')->assertSeeText('Halo Adi Ganteng');
        $this->post('/input', ['name' => 'Adi Ganteng'])->assertSeeText('Halo Adi Ganteng');
    }

    public function testNestedInput()
    {
        $this->post('/nested', [
            'name' => [
                'first' => 'Adi',
                'last' => 'Hidayat'
            ]
        ])->assertSeeText('Adi Hidayat');
    }

    public function testAllInput()
    {
        $this->post('/allinput', [
            'name' => 'Adi Hidayat',
            'email' => 'adihidayat.lpg@gmail.com',
            'phone' => 123
        ])->assertSeeText("name")->assertSeeText("Adi")->assertSeeText("email");
    }

    public function testArrayInput()
    {
        $this->post('/arrayinput', [
            'products' => [
                ['name' => 'Apple Macbook Pro'],
                ['name' => 'Samsung Galaxy S23']
            ]
        ])->assertSeeText('Apple Macbook Pro');
    }
}
