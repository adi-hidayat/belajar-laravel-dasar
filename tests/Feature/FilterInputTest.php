<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterInputTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInputOnly()
    {
        $this->post('/inputonly', [
            'name' => 'Adi',
            'gender' => 'Male',
            'age'   => 28
        ])->assertSeeText('Adi')
          ->assertDontSeeText('Male')
          ->assertSeeText('28');
    }

    public function testInputExcept()
    {
        $this->post('/inputexcept', [
            'name' => 'Adi',
            'gender' => 'Male',
            'age'   => 28
        ])->assertDontSeeText('Adi')
          ->assertSeeText('Male')
          ->assertDontSeeText('28');
    }

    public function testInputMerge()
    {
        $this->post('/mergeinput', [
            'name' => 'Adi',
            'gender' => 'Male',
            'age'   => 28
        ])->assertSeeText('Web Developer');
    }
}
