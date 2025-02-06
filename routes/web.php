<?php


use App\Models\paymentmba;
use App\Models\belumvalidasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Btc0Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ditolakController;
use App\Http\Controllers\DiterimaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaymentmbaController;
use App\Http\Controllers\BelumvalidasiController;
use App\Http\Controllers\PaymentmbafeeController;
use App\Http\Controllers\jenispengajuanController;

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
// Route::get('/success', function () { return view('success'); })->name('.page');
Route::get('/generate-Kode-pengajuan', [PaymentmbafeeController::class, 'generateKodepengajuan']);
Route::get('/admin/payment_mba_no_fee_admin', [PaymentmbafeeController::class, 'showAlerts'])->name('admin.payment_mba_no_fee_admin');

//di tolak
Route::get('/ditolak', [ditolakController::class, 'index'])->name('ditolak');

//di proses
Route::get('/belumvalidasi', [BelumvalidasiController::class, 'index'])->name('belumvalidasi')->middleware('auth');
Route::get('/api/get-belumvalidasi-count', function () {$count = DB::table('payment_mba')->count(); return response()->json(['count' => $count]);});// Gantilah 'ditolak' dengan nama tabel yang benar

//diterima
Route::get('/diterima', [DiterimaController::class, 'index'])->name('diterima')->middleware('auth');

//jenis pengajuan
Route::get('/admin/pengajuan', [jenispengajuanController::class, 'index'])->name('admin.pengajuan');

//dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');
// Route::match(['get', 'post'], '/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

Route::get('/api/get-ditolak-count', function () {$count = DB::table('ditolak')->count(); return response()->json(['count' => $count]);});// Gantilah 'ditolak' dengan nama tabel yang benar
Route::get('/api/get-diterima-count', function () {$count = DB::table('diterima')->count(); return response()->json(['count' => $count]);});// Gantilah 'ditolak' dengan nama tabel yang benar

Route::get('/admin/profil', [ProfilController::class, 'index'])->name('admin.profil');

// Route::get('/generate-kode-pengajuan', [PaymentmbaController::class, 'generateKodePengajuan']);

Route::put('/update_nofee{id}', [paymentmbafeeController::class, 'update'])->name('update_nofee');
//am wilayah componen
// fee admin
//no fee admin



// BTC0
Route::get('/candle0', [Btc0Controller::class, 'index'])->name('index.index0');
Route::get('/tablelist0', [Btc0Controller::class, 'table'])->name('index.tablelist0');








