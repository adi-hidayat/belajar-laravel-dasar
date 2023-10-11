<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieController extends Controller
{
    
    public function createCookie()
    {
        return response('Hello Cookie')
                ->cookie('User-ID', 'Adi', 1000, '/')
                ->cookie('User-Member', 'true', 1000, '/');
    }

    public function getCookie(Request $request)
    {
        return response()
                ->json([
                    'UserID' => $request->cookie('User-ID', 'guest'),
                    'UserMember' => $request->cookie('User-Member', 'false')
                ]);
    }

    public function getAllCookies(Request $request)
    {
        return response()
                ->json([$request->cookies->all()]);
    }

    public function clearCookie(Request $request) 
    {
        return response('Clear Cookie')
                ->withoutCookie('User-ID')
                ->withoutCookie('User-Member');
    }

    
}
