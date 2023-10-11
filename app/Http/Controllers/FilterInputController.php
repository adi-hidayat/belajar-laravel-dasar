<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterInputController extends Controller
{
    public function filterRequestOnly(Request $request) {
        // hanya ambil input name dan age
        $getOnlyInput = $request->only(['name', 'age']);
        return json_encode($getOnlyInput);
    }

    public function filterRequestExcept(Request $request) {
        // jangan ambil input name dan age
        $getAllExcept = $request->except(['name', 'age']);
        return json_encode($getAllExcept);
    }

    public function mergeInput(Request $request)
    {
        $request->merge(['position' => 'Web Developer', 'bidang' => 'IT']);
        $userInput = $request->input();

        return json_encode($userInput);
    }
}
