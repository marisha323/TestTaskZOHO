<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('/index',[HomeController::class,"index"]);
Route::post('/index',[HomeController::class,"index"]);
Route::get('/suppliers',[HomeController::class,"suppliers"]);
Route::post('/suppliers',[HomeController::class,"suppliersCreate"]);
Route::post('/deal',[HomeController::class,"dealCreate"]);