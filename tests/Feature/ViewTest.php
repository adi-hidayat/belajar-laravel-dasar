<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHelloView()
    {
        $this->get('/hello')->assertSeeText('Hello Adi Hidayat');
        $this->get('/hello-again')->assertSeeText('Hello Adi Hidayat');
    }

    //Nested View Directory
    public function testViewNested()
    {
        $this->get('/profile')->assertSeeText('Hello Adi Hidayat');
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Adi Hidayat'])->assertSeeText('Hello Adi Hidayat');
        $this->view('admin.profile', ['name' => 'Adi Hidayat'])->assertSeeText('Hello Adi Hidayat');
    }
}
