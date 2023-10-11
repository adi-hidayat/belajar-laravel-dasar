<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptDecryptTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEncrypt()
    {
        $encrypt = Crypt::encrypt("Adi Hidayat");
        $decrypted = Crypt::decrypt($encrypt); 

        self::assertEquals("Adi Hidayat", $decrypted);
    }
}
