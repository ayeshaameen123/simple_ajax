<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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
    return view('test.index');
});
Route::get('/', [TestController::class, 'index']);
Route::get('/view', [TestController::class, 'getdata']);
Route::get('/create', [TestController::class, 'create']);
Route::post('/add_data', [TestController::class, 'store']);
Route::post('delete', [TestController::class, 'destroy']);
Route::post('show', [TestController::class, 'show']);
