<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function request(Request $request)
    {
        return $request->path() . PHP_EOL .
               $request->url() . PHP_EOL .
               $request->fullUrl() . PHP_EOL .
               $request->method() . PHP_EOL .
               $request->header('Accept');
    }

    public function check_method(Request $request)
    {
        $method = $request->method();
        $is_method = $request->isMethod('get') ? 'GET' : 'POST';

        return "Method " . $method  . "[$is_method]";
    }

}
