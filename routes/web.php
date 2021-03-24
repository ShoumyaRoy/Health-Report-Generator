<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

// Route::get('/index', function () {
//     return view('index');
// });
Route::get('/index', [
   'uses' => 'Controller@index',
]);
// Route::post('/index', 'Controller@index');
// Route::post('/index', 'Controller::class');
Route::post('/submit', [
   'uses' => 'Controller@submit',
]);
Route::get('/table', [
   'uses' => 'Controller@table',
]);
Route::get('/download/{id}', [
   'uses' => 'Controller@download',
]);
Route::get('/export', 'Controller@export');
// Route::get('ajax',function() {
//    return view('index');
// });
Route::post('/getlogo','Controller@getlogo');

