<?php

use App\Http\Controllers\back\{
    LoginController,
    PengaturanController,
    UserController
};
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

Route::get('/dashboard/kooperasi', function () {
    return view('back.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	
    //logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    //profile
    Route::get('/myprofile{id}', [UserController::class,'profile'])->name('profile');
    Route::post('/myprofile{id}', [UserController::class,'updateProfile'])->name('profile.update');

    //users
    Route::get('/user', [UserController::class, 'index'])->name('users.index')->middleware(['auth', 'verified', 'permission:lihat-user']);
    Route::get('/user/create', [UserController::class, 'create'])->name('users.tambah')->middleware(['auth', 'verified', 'permission:tambah-user']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware(['auth', 'verified', 'permission:edit-user']);
    Route::get('/user/profile/{id}', [UserController::class, 'profile'])->name('users.profile');
    Route::post('/user/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/user/profile/update/{id}', [UserController::class, 'updateProfile'])->name('users.profile.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('users.delete')->middleware(['auth', 'verified', 'permission:hapus-user']);

    //pengaturan
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan/store', [PengaturanController::class, 'store'])->name('pengaturan.store');
    Route::post('/pengaturan/update{id}', [PengaturanController::class, 'update'])->name('pengaturan.update');
});