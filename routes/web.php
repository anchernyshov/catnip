<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Dashboard;
use App\Livewire\LoginForm;
use App\Livewire\UserDataTable;
use App\Livewire\RoleDataTable;

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

Route::get('/login', LoginForm::class)->name('login');
Route::get('/logout', [ LoginForm::class, 'logout' ])->name('logout');

Route::middleware('simple')->group(function() {
    Route::get('/', Dashboard::class);
    Route::get('/users', UserDataTable::class);
    Route::get('/roles', RoleDataTable::class);
});