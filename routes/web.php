<?php

use App\Http\Controllers\back\{
    LoginController,
    PengaturanController,
    simpananKreditController,
    UserController
};
use App\Http\Controllers\back\AnggotaController;
use App\Http\Controllers\back\SaldoController;
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

    //Anggota 
    Route::get('/Anggota', [AnggotaController::class, 'index'])->name('anggota.index')->middleware(['auth', 'verified', 'permission:lihat-anggota']);
    Route::get('/Anggota/tambah', [AnggotaController::class, 'create'])->name('anggota.tambah')->middleware(['auth', 'verified', 'permission:tambah-anggota']);
    Route::get('/anggota/{kodeAnggota}', [AnggotaController::class, 'getInfo']);
    Route::get('/Anggota/edit{kode_anggota}', [AnggotaController::class, 'edit'])->name('anggota.edit')->middleware(['auth', 'verified', 'permission:edit-anggota']);
    Route::post('/Anggota/store', [AnggotaController::class, 'store'])->name('anggota.store')->middleware(['auth', 'verified', 'permission:tambah-anggota']);
    Route::post('/Anggota/update{kode_anggota}', [AnggotaController::class, 'update'])->name('anggota.update')->middleware(['auth', 'verified', 'permission:edit-anggota']);
    Route::post('/Anggota/delete', [AnggotaController::class, 'delete'])->name('anggota.delete')->middleware(['auth', 'verified', 'permission:hapus-anggota']);

    //saldo koperasi
    Route::get('/saldo', [SaldoController::class, 'index'])->name('saldo.index')->middleware(['auth', 'verified', 'permission:lihat-saldo']);
    Route::get('/saldo/edit/{id_saldo}', [SaldoController::class, 'edit'])->name('saldo.edit')->middleware(['auth', 'verified', 'permission:edit-saldo']);
    Route::post('/saldo/store', [SaldoController::class, 'store'])->name('saldo.store')->middleware(['auth', 'verified', 'permission:tambah-saldo']);
    Route::post('/saldo/update{id_saldo}', [SaldoController::class, 'update'])->name('saldo.update')->middleware(['auth', 'verified', 'permission:edit-saldo']);
    Route::post('/saldo/delete', [SaldoController::class, 'delete'])->name('saldo.delete')->middleware(['auth', 'verified', 'permission:hapus-anggota']);

    //simpenan kredit
    Route::get('/simpanan/kredit', [simpananKreditController::class, 'index'])->name('simpananKredit.index')->middleware(['auth', 'verified', 'permission:lihat-simpananKredit']);
    Route::get('/simpanan/kredit/tambah', [simpananKreditController::class, 'create'])->name('simpananKredit.tambah')->middleware(['auth', 'verified', 'permission:tambah-simpananKredit']);
    Route::get('/simpanan/kredit/edit{kode_simpanan_kredit}', [simpananKreditController::class, 'edit'])->name('simpananKredit.edit')->middleware(['auth', 'verified', 'permission:edit-simpananKredit']);
    Route::post('/simpanan/kredit/store', [simpananKreditController::class, 'store'])->name('simpananKredit.store')->middleware(['auth', 'verified', 'permission:tambah-simpananKredit']);
    Route::post('/simpanan/kredit/update{kode_simpanan_kredit}', [simpananKreditController::class, 'update'])->name('simpananKredit.update')->middleware(['auth', 'verified', 'permission:edit-simpananKredit']);
    Route::post('/simpanan/kredit/delete', [simpananKreditController::class, 'delete'])->name('simpananKredit.delete')->middleware(['auth', 'verified', 'permission:hapus-simpananKredit']);

    //simpanan debet
    Route::get('/simpanan/debet', [simpananKreditController::class, 'index'])->name('simpananDebet.index')->middleware(['auth', 'verified', 'permission:lihat-simpananDebet']);
    Route::get('/simpanan/debet/tambah', [simpananKreditController::class, 'create'])->name('simpananDebet.tambah')->middleware(['auth', 'verified', 'permission:tambah-simpananDebet']);
    Route::get('/simpanan/debet/edit{kode_simpanan_kredit}', [simpananKreditController::class, 'edit'])->name('simpananDebet.edit')->middleware(['auth', 'verified', 'permission:edit-simpananDebet']);
    Route::post('/simpanan/debet/store', [simpananKreditController::class, 'store'])->name('simpananDebet.store')->middleware(['auth', 'verified', 'permission:tambah-simpananDebet']);
    Route::post('/simpanan/debet/update{kode_simpanan_kredit}', [simpananKreditController::class, 'update'])->name('simpananDebet.update')->middleware(['auth', 'verified', 'permission:edit-simpananDebet']);
    Route::post('/simpanan/debet/delete', [simpananKreditController::class, 'delete'])->name('simpananDebet.delete')->middleware(['auth', 'verified', 'permission:hapus-simpananDebet']);

});