<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request) : string 
    {
        $request->session()->put('userName', "JackSparrow");
        $request->session()->put('position', "captain");

        return "OK";
    }

    public function getSession(Request $request) : string 
    {
        $session = $request->session()->get('userName');
        return $session;
    }

    public function removeAllSession(Request $request) : string {
        $sessionRemoved = $request->session()->flush();
        
        if ($sessionRemoved) {
            return "OK";
        }
    }
}
