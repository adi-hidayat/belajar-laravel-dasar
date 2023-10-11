<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputTypeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Adi Hidayat',
            'handsome' => 'true',
            'birth_date' => '05-09-1995'
        ])->assertSeeText('Adi Hidayat')->assertSeeText('true')->assertSeeText('1995-09-05');
    }
}
