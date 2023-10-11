<?php

namespace App\Http\Controllers;

use App\Data\Foo;
use Illuminate\Http\Request;

class InputTypeController extends Controller
{
    public function inputType(Request $request) : string
    {
        $name = $request->input('name');

        // dengan konversi
        $handsome = $request->boolean('handsome');
        $birthDate = $request->date('birth_date', 'Y-m-d');

        return json_encode([
           'name' => $name,
           'handsome' => $handsome,
           'birth_date' => $birthDate->format('d-m-Y')
        ]);
    }
}
