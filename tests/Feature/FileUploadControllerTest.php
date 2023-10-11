<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileUploadControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpload()
    {
       $image = UploadedFile::fake()->image("AdiGanteng.png");
       $this->post('/upload', [
            'picture' => $image
       ])->assertSeeText("OK : AdiGanteng.png");
    }
}
