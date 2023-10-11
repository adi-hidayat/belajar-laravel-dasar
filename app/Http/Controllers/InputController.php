<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function input(Request $request)
    {
        $name = $request->input('name');
        return "Halo " . $name;
    }

    public function nestedInput(Request $request)
    {
        $firstName = $request->input('name.first');
        $lastName = $request->input('name.last');
        return $firstName . ' ' . $lastName;
    }

    public function allInput(Request $request)
    {
        // akan menerima semua input dari form input, maupun dari query parameter
        return json_encode($request->input());
    }

    public function arrayInput(Request $request)
    {
        // mengambil input product, dimana nama adalah nested array dari product
        // dan hanya ingin mengambil data name nya saja
        $post = $request->input('products.*.name');
        return json_encode($post);
    }

    public function dynamicProperties(Request $request) {
        // yang biasa kita lakukan
        $name = $request->input('name');

        // menggunakan dynamic property, tapi ini tidak direkomendasikan
        $name = $request->name;
    }
}
