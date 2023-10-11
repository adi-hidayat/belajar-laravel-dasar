<?php

use App\Exceptions\SampleIgnoreException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\CsrfTokenController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\FilterInputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\SampleMiddleware;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 20 Routing
Route::get('/ganteng', function(){
    return "Hello adi ganteng";
});

// redirect
Route::redirect('/jelek', '/ganteng');

// fallback route, digunakan ketika halaman yang diakses tidak tersedia
Route::fallback(function(){
    return "Gak ada route";
});

// 21 view
Route::view('/hello', 'hello', ['name' => 'Adi Hidayat']);

// closure
Route::get('/hello-again', function() {
   return view('hello', ['name' => 'Adi Hidayat']);
});

// Nested View Directory
Route::view('profile', 'admin.profile', ['name' => 'Adi Hidayat']);

// 23 Route Parameter
Route::get('/products/{id}', function($productId){
    return "Products : " . $productId;
});

Route::get('/products/{product}/items/{item}', function($productid, $itemid){
   return "Products : " . $productid  . ", Items : " . $itemid;
});

//Regular Expression Constraints
Route::get('/categories/{id}', function(string $categoryId){
    return "Categories : " . $categoryId;
})->where('id', '[0-9]+');

// Optional Route Parameter
Route::get('/users/{id?}', function(string $userId = 'Guess') {
    return "Users : " . $userId;
});

//Routing Conflict
Route::get('/conflict/{adi}', function(){
    return "Search dengan Parameter Adi";
});

Route::get('/conflict/adi', function(){
    return "Search dengan Method Adi";
});

//Named Route
Route::get('/invoice', function(){
    return "Invoice";
})->name('invoice');

Route::get('/invoice/{id}', function($id){
    return "Invoice" . $id;
})->name('invoice.detail');

Route::get('/faktur/{id}', function($id){
   $link = route('invoice.detail', [
       'id' => $id
   ]) ;

   return $link;
});

Route::get('/faktur-redirect/{id}', function($id){
   return redirect()->route('invoice.detail', [
       'id' => $id
   ]);
});

// 25 Controller | Routing / Registrasi controller
Route::get('/controller/hello', [\App\Http\Controllers\HelloController::class, 'hello']);

//26 Request
Route::get('/request', [\App\Http\Controllers\RequestController::class, 'request']);
Route::get('request/check_method', [\App\Http\Controllers\RequestController::class, 'check_method']);

// 27 Request Input
Route::get('input', [\App\Http\Controllers\InputController::class, 'input']);
Route::post('input', [\App\Http\Controllers\InputController::class, 'input']);
Route::post('nested', [\App\Http\Controllers\InputController::class, 'nestedInput']);
Route::post('allinput', [\App\Http\Controllers\InputController::class, 'allInput']);
Route::post('arrayinput', [\App\Http\Controllers\InputController::class, 'arrayInput']);

// 28 Input Type
Route::post('inputtype', [\App\Http\Controllers\InputTypeController::class, 'inputType']);

// 29 Filter Input
Route::post('inputonly', [FilterInputController::class, 'filterRequestOnly']);
Route::post('inputexcept', [FilterInputController::class, 'filterRequestExcept']);
Route::post('mergeinput', [FilterInputController::class, 'mergeInput']);

// 31 File Upload
Route::post('upload', [FileUploadController::class, 'upload']);

// 32 Response 
Route::get('response', [ResponseController::class, 'response']);
Route::get('header', [ResponseController::class, 'responseWithHeader']);
Route::get('responseview', [ResponseController::class, 'responseView']);
Route::get('responsejson', [ResponseController::class, 'responseJson']);
Route::get('responsefile', [ResponseController::class, 'responseFile']);
Route::get('responsedownload', [ResponseController::class, 'responseDownload']);

// 34 Cookie
Route::get('cookie', [CookieController::class, 'createCookie']);
Route::get('getcookie', [CookieController::class, 'getCookie']);
Route::get('getallcookies', [CookieController::class, 'getAllCookies']);
Route::get('clearcookie', [CookieController::class, 'clearCookie']);

// 35 Redirect 
Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);
Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/hello{name}', [RedirectController::class, 'redirectHello'])->name("redirect-hello");
Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [RedirectController::class, 'redirectAway']);

// 36 Middleware
Route::get('middleware/api', function(){
    return "OK";
})->middleware([SampleMiddleware::class]); // atau bisa dengan alias middleware middleware(['contoh'])

// middleware group
Route::get('middleware/group', function(){
    return "GROUP";
})->middleware(['sample_group_middleware']); 

// middleware with parameter
Route::get('middleware/parameter', function(){
    return "GROUP";
})->middleware(['sample_group_middleware:parameter1, parameter2']); 

// without middleware
Route::post('upload', [FileUploadController::class, 'uploadFile'])
        ->withoutMiddleware([VerifyCsrfToken::class]);


// 37 CSRF
Route::get('csrf', [CsrfTokenController::class, 'index']);
Route::post('csrf', [CsrfTokenController::class, 'index']);

// 38 Route Group

// Route prefix
Route::prefix('/response/type')->group(function(){
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
});

// Route Middleware
Route::middleware(['nama_group_atau_nama_midleware:param_jika_ada,param_lainjika_ada'])->group(function(){
    Route::get('/person/api', function(){
        return "OK";
    });
});

//Route Controller
Route::controller(ResponseController::class)->group(function(){
    Route::get('/view', 'responseView');
    Route::get('/json', 'responseJson');
    Route::get('/file', 'responseFile');
    Route::get('/download', 'responseDownload');
});

// Multiple Route Group
Route::middleware(['nama_group_atau_nama_midleware:param_jika_ada,param_lainjika_ada'])->prefix('/middleware')->group(function(){
    Route::get('/api', function(){
        return "OK";
    });
});

// 39 URL Generation
Route::get('/url/current', function(){
    return URL::full();
});

Route::get('/redirect/name/{name}', function(){
    return url()->current();
})->name('hello-named');

Route::get('/url/named', function() {
    return route('hello-named', ['name' => 'Adi']);
});

Route::get('/url/action', function(){
    return action([CsrfTokenController::class, 'index'], []);
});

Route::prefix('/session')->group(function () {
    Route::get('/create', [SessionController::class, 'createSession']);
    Route::get('/get', [SessionController::class, 'getSession']);
    Route::get('/remove', [SessionController::class, 'removeSession']);
});

// 41 Error Exception
Route::get('/error/exception', function(){
    throw new Exception("Ini Error");
});

// Manual Error Report
Route::get('error/manual', function(){
    report(new Exception("Error!"));

    return "OK";
});

// Ignote Exception
Route::get('error/ignore', function(){
    // tidak akan mengeksekusi reportable error, tapi tetap menampilkan error
    throw new SampleIgnoreException('Error');
});

// 42 HTTP exception
Route::get('/abort/{status_code}', function($status_code){
    abort($status_code, "Upss Error");
});