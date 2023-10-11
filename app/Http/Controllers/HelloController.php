<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    // 25 : Controller, Dependency Injection
    // menggunakan service container
    private HelloService $helloService;

    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function hello() : string
    {
        return $this->helloService->hello("Adi Hidayat");
    }
}
