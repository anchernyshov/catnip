<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;


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
    return view('app');
})->middleware('simple');

Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
});