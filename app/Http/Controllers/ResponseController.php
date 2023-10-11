<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request)
    {
        return response("Hello Response");
    }

    public function responseWithHeader(Request $requst)
    {
        $body = ['firstName' => "Adi", 'lastName' => "Hidayat"];
        return response(json_encode($body), 200)
                ->header('Content-Type', 'application/json')
                ->withHeaders([
                    'Author' => 'Adi Hidayat',
                    'App' => 'Belajar Laravel'
                ]);
    }

    public function responseView(Request $request) : Response
    {
        return response()
                ->view('hello', ['name' => "Adi"]);
    }

    public function responseJson(Request $request) : JsonResponse
    {
        $body = ['firstName' => "Adi", 'lastName' => "Hidayat"];
        return response()->json($body);

    }

    public function responseFile(Request $request) : BinaryFileResponse
    {
        return response()->file(storage_path('app/public/pictures/AdiGanteng.png'));
    }

    public function responseDownload(Request $request) : BinaryFileResponse
    {
        return response()->download(storage_path('app/public/pictures/AdiGanteng.png'));
    }
}
