<?php

use App\Models\paymentmbafee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Btc0Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaymentmbaController;
use App\Http\Controllers\PaymentmbafeeController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/login', function () {
//     return class_exists(LoginController::class) ? 'Controller exists' : 'Controller not found';
//});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'cek_login'])->name('cek_login');
Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home');

//payment mba fee admin
Route::get('/admin/payment_mba_admin', [PaymentmbaController::class, 'index'])->name('payment_mba_admin');
Route::post('/ajukan', [PaymentmbaController::class, 'store'])->name('ajukan');
Route::get('/success', function () { return view('success'); })->name('success.page');
Route::get('/generate-Kode-pengajuan', [PaymentmbaController::class, 'generateKodepengajuan']);
Route::get('/admin/payment_mba_admin', [PaymentmbaController::class, 'showAlerts'])->name('admin.payment_mba_admin');

//payment mba no fee admin
Route::get('/admin/payment_mba_no_fee_admin', [PaymentmbafeeController::class, 'index'])->name('payment_mba_no_fee_admin');
Route::post('/submit', [PaymentmbafeeController::class, 'store'])->name('submit');
Route::get('/berhasil', function () { return view('berhasil'); })->name('berhasil.page');
Route::get('/generate-Kode-pengajuan', [PaymentmbafeeController::class, 'generateKodepengajuan']);
Route::get('/admin/payment_mba_no_fee_admin', [PaymentmbafeeController::class, 'showAlerts'])->name('admin.payment_mba_no_fee_admin');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/profil', [ProfilController::class, 'index'])->name('admin.profil');

Route::put('/update_nofee{id}', [paymentmbafeeController::class, 'update'])->name('update_nofee');
// Route::get('/admin/profil', [AdminController::class, 'index'])->name('admin.profil');

//am wilayah componen
// fee admin
//no fee admin



// BTC0
Route::get('/candle0', [Btc0Controller::class, 'index'])->name('index.index0');
Route::get('/tablelist0', [Btc0Controller::class, 'table'])->name('index.tablelist0');
Route::get('/tableditolak0', [Btc0Controller::class, 'tbtlk'])->name('index.tbtolak0');
Route::get('/tabledisetujui0', [Btc0Controller::class, 'tbstj'])->name('index.tbsetuju0');
Route::get('/input0', [Btc0Controller::class, 'input'])->name('index.input0');
Route::get('/user0', [Btc0Controller::class, 'user'])->name('index.user0');
Route::get('/detail0', [Btc0Controller::class, 'detail'])->name('index.detail0');
Route::get('/mitra0', [Btc0Controller::class, 'mitra'])->name('index.mitra0');
Route::get('/wilayah0', [Btc0Controller::class, 'wilayah'])->name('index.wilayah0');
Route::get('/pengguna0', [Btc0Controller::class, 'pengguna'])->name('index.pengguna0');
Route::get('/tambahpengguna0', [Btc0Controller::class, 'penggunaadd'])->name('index.penggunaadd0');
Route::get('/detailpengguna0', [Btc0Controller::class, 'detailuser'])->name('index.detailuser0');










