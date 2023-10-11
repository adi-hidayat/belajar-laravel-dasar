<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfiguration()
    {
        $delivery_fee = config('delivery.delivery_fee');
        self::assertEquals(10, $delivery_fee);

        $destinations = config('delivery.destinations.west');
        self::assertEquals("West Jakarta", $destinations);
    }
}
