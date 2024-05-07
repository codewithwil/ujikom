<?php

use App\Http\Controllers\back\LoginController;
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
    return view('front.home.index');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.go');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard/kooperasi', function () {
    return view('back.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');