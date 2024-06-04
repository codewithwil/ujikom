<?php

use App\Http\Controllers\back\{
    LoginController,
    PengaturanController,
    PinjamanDebetController,
    PinjamanKreditController,
    simpananKreditController,
    UserController,
    AnggotaController,
    angsuranController,
    KeteranganController,
    LaporanController,
    SaldoController,
    SimpananDebetController,
    PinjamanKredit,
    SaldoKreditController
};

use App\Http\Controllers\back\DashboardController;
use App\Http\Controllers\back\jenisSimpananController;
use App\Models\Saldo;
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

Route::middleware('guest')->group(function () {
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.go');
});
Route::get('/dashboard/kooperasi', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('daily-simpanan-transactions', [DashboardController::class, 'dailySimpananTransactions'])->name('daily.simpanan.transactions');
    Route::get('daily-pinjaman-transactions', [DashboardController::class, 'dailyPinjamanTransactions'])->name('daily.pinjaman.transactions');
    //logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    //profile
    Route::get('/myprofile{id}', [UserController::class,'profile'])->name('profile');
    Route::post('/myprofile{id}', [UserController::class,'updateProfile'])->name('profile.update');

    //users
    Route::get('/user', [UserController::class, 'index'])->name('users.index')->middleware(['auth', 'verified', 'permission:lihat-user']);
    Route::get('/user/create', [UserController::class, 'create'])->name('users.tambah')->middleware(['auth', 'verified', 'permission:tambah-user']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
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

    //saldo koperasi debet
    Route::get('/saldo/debet', [SaldoController::class, 'index'])->name('saldo.index')->middleware(['auth', 'verified', 'permission:lihat-saldo']);
    Route::get('/saldo/tambah', [SaldoController::class, 'create'])->name('saldo.tambah')->middleware(['auth', 'verified', 'permission:tambah-saldo']);
    Route::get('/saldo/edit/{id_saldo}', [SaldoController::class, 'edit'])->name('saldo.edit')->middleware(['auth', 'verified', 'permission:edit-saldo']);
    Route::post('/saldo/store', [SaldoController::class, 'store'])->name('saldo.store')->middleware(['auth', 'verified', 'permission:tambah-saldo']);
    Route::post('/saldo/update{id_saldo}', [SaldoController::class, 'update'])->name('saldo.update')->middleware(['auth', 'verified', 'permission:edit-saldo']);
    Route::post('/saldo/delete', [SaldoController::class, 'delete'])->name('saldo.delete')->middleware(['auth', 'verified', 'permission:hapus-anggota']);

    //saldo koperasi kredit
    Route::get('/saldo/kredit', [SaldoKreditController::class, 'index'])->name('saldo.kredit.index')->middleware(['auth', 'verified', 'permission:lihat-saldo']);
    Route::get('/saldo/tambah', [SaldoKreditController::class, 'create'])->name('saldo.tambah')->middleware(['auth', 'verified', 'permission:tambah-saldo']);
    Route::get('/saldo/edit/{id_saldo_kredit}', [SaldoKreditController::class, 'saldo-kredit'])->name('saldo.kredit.edit')->middleware(['auth', 'verified', 'permission:edit-saldo']);
    Route::post('/saldo/store', [SaldoKreditController::class, 'store'])->name('saldo.store')->middleware(['auth', 'verified', 'permission:tambah-saldo']);
    Route::post('/saldo/update{id_saldo}', [SaldoKreditController::class, 'update'])->name('saldo.update')->middleware(['auth', 'verified', 'permission:edit-saldo']);
    Route::post('/saldo/delete', [SaldoKreditController::class, 'delete'])->name('saldo.delete')->middleware(['auth', 'verified', 'permission:hapus-anggota']);

    //simpenan kredit
    Route::get('/simpanan/kredit', [simpananKreditController::class, 'index'])->name('simpananKredit.index')->middleware(['auth', 'verified', 'permission:lihat-simpananKredit']);
    Route::get('/cek-simpan-debet/{kode_anggota}', [simpananKreditController::class, 'cekSimpanDebet'])->name('simpananKredit.cek')->middleware(['auth', 'verified', 'permission:lihat-simpananKredit']);
    Route::get('/simpanan/kredit/tambah', [simpananKreditController::class, 'create'])->name('simpananKredit.tambah')->middleware(['auth', 'verified', 'permission:tambah-simpananKredit']);
    Route::get('/simpanan/kredit/edit{kode_simpanan_kredit}', [simpananKreditController::class, 'edit'])->name('simpananKredit.edit')->middleware(['auth', 'verified', 'permission:edit-simpananKredit']);
    Route::post('/simpanan/kredit/store', [simpananKreditController::class, 'store'])->name('simpananKredit.store')->middleware(['auth', 'verified', 'permission:tambah-simpananKredit']);
    Route::post('/simpanan/kredit/update{kode_simpanan_kredit}', [simpananKreditController::class, 'update'])->name('simpananKredit.update')->middleware(['auth', 'verified', 'permission:edit-simpananKredit']);
    Route::post('/simpanan/kredit/delete', [simpananKreditController::class, 'delete'])->name('simpananKredit.delete')->middleware(['auth', 'verified', 'permission:hapus-simpananKredit']);


    //jenis sipmpanan
    Route::get('/jenisSimpanan', [jenisSimpananController::class, 'index'])->name('jenisSimpanan.index')->middleware(['auth', 'verified', 'permission:lihat-simpananDebet']);
    Route::get('jenisSimpanan/tambah', [jenisSimpananController::class, 'create'])->name('jenisSimpanan.tambah')->middleware(['auth', 'verified', 'permission:tambah-simpananDebet']);
    Route::get('/jenisSimpanan/edit{kode_simpanan_debet}', [jenisSimpananController::class, 'edit'])->name('jenisSimpanan.edit')->middleware(['auth', 'verified', 'permission:edit-simpananDebet']);
    Route::post('/jenisSimpanan/store', [jenisSimpananController::class, 'store'])->name('jenisSimpanan.store')->middleware(['auth', 'verified', 'permission:tambah-simpananDebet']);
    Route::post('/jenisSimpanan/update{kode_simpanan_debet}', [jenisSimpananController::class, 'update'])->name('jenisSimpanan.update')->middleware(['auth', 'verified', 'permission:edit-simpananDebet']);
    Route::post('/jenisSimpanan/delete', [jenisSimpananController::class, 'delete'])->name('jenisSimpanan.delete')->middleware(['auth', 'verified', 'permission:hapus-simpananDebet']);

    //simpanan debet
    Route::get('/simpanan/debet', [SimpananDebetController::class, 'index'])->name('simpananDebet.index')->middleware(['auth', 'verified', 'permission:lihat-simpananDebet']);
    Route::get('simpanan/tambah', [SimpananDebetController::class, 'create'])->name('simpananDebet.tambah')->middleware(['auth', 'verified', 'permission:tambah-simpananDebet']);
    Route::get('/simpanan/debet/edit{kode_simpanan_debet}', [SimpananDebetController::class, 'edit'])->name('simpananDebet.edit')->middleware(['auth', 'verified', 'permission:edit-simpananDebet']);
    Route::post('/simpanan/debet/store', [SimpananDebetController::class, 'store'])->name('simpananDebet.store')->middleware(['auth', 'verified', 'permission:tambah-simpananDebet']);
    Route::post('/simpanan/debet/update{kode_simpanan_debet}', [SimpananDebetController::class, 'update'])->name('simpananDebet.update')->middleware(['auth', 'verified', 'permission:edit-simpananDebet']);
    Route::post('/simpanan/debet/delete', [SimpananDebetController::class, 'delete'])->name('simpananDebet.delete')->middleware(['auth', 'verified', 'permission:hapus-simpananDebet']);

    //pinjaman debet
    Route::get('/pinjaman/debet', [PinjamanDebetController::class, 'index'])->name('pinjamanDebet.index')->middleware(['auth', 'verified', 'permission:lihat-pinjamanDebet']);
    Route::get('/pinjaman/debet/tambah', [PinjamanDebetController::class, 'create'])->name('pinjamanDebet.tambah')->middleware(['auth', 'verified', 'permission:tambah-pinjamanDebet']);
    Route::get('/pinjaman/debet/edit{kode_pinjaman_debet}', [PinjamanDebetController::class, 'edit'])->name('pinjamanDebet.edit')->middleware(['auth', 'verified', 'permission:edit-pinjamanDebet']);
    Route::post('/pinjaman/debet/store', [PinjamanDebetController::class, 'store'])->name('pinjamanDebet.store')->middleware(['auth', 'verified', 'permission:tambah-pinjamanDebet']);
    Route::post('/pinjaman/debet/update{kode_pinjaman_debet}', [PinjamanDebetController::class, 'update'])->name('pinjamanDebet.update')->middleware(['auth', 'verified', 'permission:edit-pinjamanDebet']);
    Route::post('/pinjaman/debet/delete', [PinjamanDebetController::class, 'delete'])->name('pinjamanDebet.delete')->middleware(['auth', 'verified', 'permission:hapus-pinjamanDebet']);
    //pinjaman kredit
    Route::get('/pinjaman/kredit', [PinjamanKreditController::class, 'index'])->name('pinjamanKredit.index')->middleware(['auth', 'verified', 'permission:lihat-pinjamanKredit']);
    Route::get('/pinjaman/kredit/tambah', [PinjamanKreditController::class, 'create'])->name('pinjamanKredit.tambah')->middleware(['auth', 'verified', 'permission:tambah-pinjamanKredit']);
    Route::get('/pinjaman/kredit/edit{kode_pinjaman_kredit}', [PinjamanKreditController::class, 'edit'])->name('pinjamanKredit.edit')->middleware(['auth', 'verified', 'permission:edit-pinjamanKredit']);
    Route::post('/pinjaman/kredit/store', [PinjamanKreditController::class, 'store'])->name('pinjamanKredit.store')->middleware(['auth', 'verified', 'permission:tambah-pinjamanKredit']);
    Route::post('/pinjaman/kredit/update{kode_pinjaman_kredit}', [PinjamanKreditController::class, 'update'])->name('pinjamanKredit.update')->middleware(['auth', 'verified', 'permission:edit-pinjamanKredit']);
    Route::post('/pinjaman/kredit/delete', [PinjamanKreditController::class, 'delete'])->name('pinjamanKredit.delete')->middleware(['auth', 'verified', 'permission:hapus-pinjamanKredit']);

    //angsuran debet
    Route::get('/angsuran/debet', [angsuranController::class, 'debet'])->name('angsuran.debet')->middleware(['auth', 'verified', 'permission:lihat-angsuranDebet']);
    Route::get('/angsuran/debet/detail/{kode_simpanan_debet}', [angsuranController::class, 'debetDetail'])->name('angsuran.debet.detail')->middleware(['auth', 'verified', 'permission:lihat-angsuranDebet']);

    //angsuran kredit
    Route::get('/angsuran/kredit', [angsuranController::class, 'kredit'])->name('angsuran.kredit')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    Route::get('/angsuran/kredit/detail/{kode_pinjaman_kredit}', [angsuranController::class, 'kreditDetail'])->name('angsuran.kredit.detail')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    Route::post('/angsuran/kredit/delete', [angsuranController::class, 'delete'])->name('angsuran.delete')->middleware(['auth', 'verified', 'permission:hapus-angsuran']);

    //laporan 
    //user
    Route::get('/laporan/user', [LaporanController::class, 'user'])->name('laporan.user')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    Route::get('/print/user', [LaporanController::class, 'printUser'])->name('print.user')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    //anggota                              
    Route::get('/laporan/anggota', [LaporanController::class, 'anggota'])->name('laporan.anggota')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    Route::get('/print/anggota', [LaporanController::class, 'printAnggota'])->name('print.anggota')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);

    //saldo
    Route::get('/laporan/saldo', [LaporanController::class, 'saldo'])->name('laporan.saldo')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    Route::get('/print/saldo', [LaporanController::class, 'printSaldo'])->name('print.saldo')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);

     //Jenis simpanan
     Route::get('/laporan/jenisSimpanan', [LaporanController::class, 'jenisSimpanan'])->name('laporan.jenisSimpanan')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
     Route::get('/print/jenisSimpanan', [LaporanController::class, 'printjenisSimpanan'])->name('print.jenisSimpanan')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);

    Route::get('/laporan/simpanan', [LaporanController::class, 'simpanan'])->name('laporan.simpanan')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    Route::get('/print/simpanan', [LaporanController::class, 'printSimpanan'])->name('print.simpanan')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    Route::get('/laporan/pinjaman', [LaporanController::class, 'pinjaman'])->name('laporan.pinjaman')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    Route::get('/print/pinjaman', [LaporanController::class, 'printPinjaman'])->name('print.pinjaman')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    //angsuran debet
    Route::get('/laporan/angsuranD', [LaporanController::class, 'angsuranD'])->name('laporan.angsuranD')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    Route::get('/print/angsuranD', [LaporanController::class, 'printAngsuranD'])->name('print.angsuranD')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    //angsuran kredit
    Route::get('/laporan/angsuranK', [LaporanController::class, 'angsuranK'])->name('laporan.angsuranK')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);
    Route::get('/print/angsuranK', [LaporanController::class, 'printAngsuranK'])->name('print.angsuranK')->middleware(['auth', 'verified', 'permission:lihat-angsuranKredit']);

    Route::get('/generate-pdf', [LaporanController::class, 'generatePDF'])->name('generatepdf');

});

Route::get('/get-saldo-koperasi', [SaldoController::class, 'getSaldoKoperasi']);
