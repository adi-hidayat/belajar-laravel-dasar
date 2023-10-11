<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class FacadesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfig()
    {
        $destionation1 = config('delivery.destinations.west');
        $destionation2 = Config::get('delivery.destinations.west');

        self::assertEquals($destionation2, $destionation1);


        // melihat semua config, config yang ada di config/semua file config
//        var_dump(Config::all());
    }

    public function testConfigDependency()
    {
        $destionation1 = config('delivery.destinations.west');
        $destionation2 = Config::get('delivery.destinations.west');

        self::assertEquals($destionation2, $destionation1);

        // pada contoh diatas Config::get() itu sebenarnya sama halnya :
        $config = $this->app->make('config');
        $destination3 = $config->get('delivery.destinations.west');
//        var_dump($config->all());
        self::assertSame($destination3, $destionation1);
    }

    public function testConfigMocking()
    {
        // semua Facades selalu memiliki method shouldReceive()
//        contoh
//        Log::shouldReceive();
//        App::shouldReceive();

        Config::shouldReceive('get')
            ->with('delivery.destinations.west')
            ->andReturn("Jakarta Barat");

        $destination = Config::get('delivery.destinations.west');

        self::assertEquals("Jakarta Barat", $destination);


    }

}
