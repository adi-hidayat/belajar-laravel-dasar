<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CsrfTokenController extends Controller
{
    public function index(Request $request) : Response
    {
        $data = [];
        if ($request->isMethod('POST')) {
            $data['name'] = $request->input('name');
        }

        return response()->view('csrf_token_input', $data);
    }
}
