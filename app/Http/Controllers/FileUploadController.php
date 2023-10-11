<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // ambil file dari request atau input
        $picture = $request->file('picture');

        // jika ingin mendapatkan semua file yang di upload
        // $picture = $request->allFiles();

        // lalu simpan file ke dalam directory pictures yang ada di public 
        $picture->storePubliclyAs("pictures", $picture->getClientOriginalName(), "public");

        return "OK : " . $picture->getClientOriginalName();
    }
}
