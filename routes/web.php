<?php

use App\Http\Controllers\EsewaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/esewa',[EsewaController::class,'esewaPay'])->name('esewa');
Route::get('/success',[EsewaController::class,'esewaPaySuccess']);
Route::get('/failure',[EsewaController::class,'esewaPayFailed']);
