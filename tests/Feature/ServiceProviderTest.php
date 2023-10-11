<?php

namespace Tests\Feature;
use App\Data\Brand;
use App\Data\Car;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testServiceProvider()
    {
        // karena di carserviceprover kita sudah diregistrasikan dengan cara singleton,
        // maka seharusnya isinya sama
        $car1 = $this->app->make(Brand::class);
        $car2 = $this->app->make(Brand::class);
        self::assertSame($car1, $car2);

        $brand1 = $this->app->make(Car::class);
        $brand2 = $this->app->make(Car::class);

        self::assertSame($brand1, $brand2);
    }

    // Bindings dan Singletons Properties
    public function testPropertySingletons()
    {
        $helloService1 = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);
        self::assertSame($helloService1, $helloService2);
    }
    // Bindings dan Singletons Properties
    public function testHelloProperty()
    {

        $helloService = $this->app->make(HelloServiceIndonesia::class);
        self::assertEquals("Hello Adi", $helloService->hello("Adi"));
    }

    // test Deffered
    public function testDeffered()
    {
        // diharapkan ketika telah melakukan test ini,
        // CarserviceProvider ada dibagian deferred, cek file bootstrap/cache/service.php
        // dan dibagian eager harusnya tidak ada

        $true = true;
        self::assertTrue($true);
    }

}
