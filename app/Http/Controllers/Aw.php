<?php

namespace App\Http\Controllers;

use App\Data\Person;
use Illuminate\Http\Request;

class Aw extends Controller
{
    public function index()
    {
        $this->app->singleton(Person::class, function($app) {
            return new Person("Adi", "Hidayat");
        });

        $person = $this->app->make(Person::class);
    }
}
