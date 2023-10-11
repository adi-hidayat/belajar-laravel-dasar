<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDependency()
    {
        // jika biasanya kita gunakan new
        // $foo = new Foo();

        // dengan service container
        $foo = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertEquals("Foo", $foo->foo());
        self::assertEquals("Foo", $foo2->foo());

        // dari ke dua contoh $foo walapun menggunakan class yang sama akan tetapi akan selalu menghasilkan object yang berbeda
        self::assertNotSame($foo, $foo2);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class); tidak bisa seperti ini apabila memiliki constructor parameter

        $this->app->bind(Person::class, function($app){
            return new Person("Adi", "Hidayat");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Adi', $person1->firstName); // closure() // new Person("Adi", "Hidayat");
        self::assertEquals('Adi', $person2->firstName); // closure() // new Person("Adi", "Hidayat");
        self::assertEquals($person1, $person2);

        // walaupun menggunakan object yang sama tapi hasilnya akan berbeda karena object berikutnya merupakan
        // hasil re-create
        // self::assertSame($person1, $person2);
    }

    public function testSingleton()
    {
        // biasanya cara ini yang akan selalu digunakan ketika membuat aplikasi laravel
        $this->app->singleton(Person::class, function($app){
            return new Person("Adi", "Hidayat");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Adi', $person1->firstName); // new Person("Adi", "Hidayat"); if not exists
        self::assertEquals('Adi', $person2->firstName); // return object yang telah dibuat, tidak akan membuat object baru seperti di bind(key)

        // harusnya true, karena mnggunakan singleton object akan selalu sama walau seperti di create ulang
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Adi", "Hidayat");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Adi", $person1->firstName);
        self::assertEquals("Adi", $person2->firstName);
        self::assertSame($person, $person1);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);

        // secara default Bar membutuhkan constructor dengan parameter object foo,
        // karena sudah di inject di atas, maka Laravel secara otomatis menggunakan dependency
        // yang sesuai
        // jadi kita tidak menggunakan cara manual lagi seperti yang ada di DependencyInjectionTest.php
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }

    public function testDependencyInjectionClosure()
    {
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app){
            // jangan new Foo(), karena ini akan membuat foo yang baru, bukan menggunakan singleton yang telah kita buat
            // tapi gunakanlan $app->make(Foo::class)
            return new Bar($app->make(Foo::class));
        });

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);
        self::assertSame($bar1, $bar2);
    }

    public function testHelloService()
    {
        // bind service interface ke service container
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        //bisa menggunakan closure
        $this->app->singleton(HelloService::class, function($app){
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);
        self::assertEquals("Hello Adi", $helloService->hello("Adi"));
    }
}
