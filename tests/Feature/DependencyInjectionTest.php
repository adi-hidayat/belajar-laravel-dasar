<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDependencyInjection()
    {
       $foo = new Foo();
       
       // wajib untuk melakukan injection / memasukan object foo ke dalam object bar
       $bar = new Bar($foo);

       self::assertEquals('Foo and Bar', $bar->bar());
    }
}
