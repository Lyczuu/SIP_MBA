<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Btc0Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ditolakController;
use App\Http\Controllers\DiterimaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatamitraController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FeeditolakController;
use App\Http\Controllers\PaymentmbaController;
use App\Http\Controllers\DataditolakController;
use App\Http\Controllers\DatawilayahController;
use App\Http\Controllers\DatadiajukanController;
use App\Http\Controllers\NofeeditolakController;
use App\Http\Controllers\PaymentadminController;
use App\Http\Controllers\PenggunabaruController;
use App\Http\Controllers\BelumvalidasiController;
use App\Http\Controllers\DatadisetujuiController;
use App\Http\Controllers\NofeediterimaController;
use App\Http\Controllers\PaymentmbafeeController;
use App\Http\Controllers\jenispengajuanController;
use App\Http\Controllers\PenggunadetailController;
use App\Http\Controllers\FeebelumvalidasiController;
use App\Http\Controllers\DatadetailpaymentController;
use App\Http\Controllers\DatajenispajakController;
use App\Http\Controllers\DatajenistransaksiController;
use App\Http\Controllers\DatapengajuanintegrasiController;
use App\Http\Controllers\FeediterimaController;
use App\Http\Controllers\NofeebelumvalidasiController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\UserwilayahController;
use App\Models\Penggunabaru;
use App\Models\Userwilayah;

Route::get('/', function () {
    return view('welcome');
});

//Routing awal
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'cek_login'])->name('cek_login');
Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home');


//payment mba fee admin
Route::get('/admin/payment_mba_admin', [PaymentmbaController::class, 'index'])->name('payment_mba_admin');
Route::post('/ajukan', [PaymentmbaController::class, 'store'])->name('ajukan');
Route::get('/success', function () { return view('success'); })->name('success.page');
Route::get('/generate-Kode-pengajuan', [PaymentmbaController::class, 'generateKodepengajuan']);
//di tolak
Route::get('/ditolak', [ditolakController::class, 'index'])->name('ditolak')->middleware('auth');
Route::put('/ditolak/validate/{id}', [ditolakController::class, 'update'])->name('ditolak.update')->middleware('auth');
//diterima
Route::get('/diterima', [DiterimaController::class, 'index'])->name('diterima')->middleware('auth');
//di proses
Route::get('/belumvalidasi', [BelumvalidasiController::class, 'index'])->name('belumvalidasi')->middleware('auth');
Route::get('/api/get-belumvalidasi-count', function () {$count = DB::table('payment_mba')->count(); return response()->json(['count' => $count]);});// Gantilah 'ditolak' dengan nama tabel yang benar





//payment mba no fee admin
Route::get('/admin/payment_mba_no_fee_admin', [PaymentmbafeeController::class, 'index'])->name('payment_mba_no_fee_admin');
Route::post('/sok', [PaymentmbafeeController::class, 'store'])->name('sok');
Route::get('/generate-Kode-pengajuan', [PaymentmbafeeController::class, 'generateKodepengajuan']);
//ditolak
Route::get('/nofeeditolak', [NofeeditolakController::class, 'index'])->name('nofee.ditolak')->middleware('auth');
//di terima
Route::get('/nofeediterima', [NofeediterimaController::class, 'index'])->name('nofee.diterima')->middleware('auth');
//belum validasi
Route::get('/nofeebelumvalidasi', [NofeebelumvalidasiController::class, 'index'])->name('nofee.belumvalidasi')->middleware('auth');









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
// end Rouitng awal





//routing admin

//halaman utama
Route::get('/utama', [Btc0Controller::class, 'index'])->name('index.index0');

//data dijukan
Route::get('/datadiajukan', [DatadiajukanController::class, 'index'])->name('admin.datadiajukan')->middleware('auth');

//data ditolak
Route::get('/dataditolak', [DataditolakController::class, 'index'])->name('data.ditolak')->middleware('auth');

//data disetujui
Route::get('/datadisetujui', [DatadisetujuiController::class, 'index'])->name('data.disetujui')->middleware('auth');

//data detail
Route::get('/datadetail', [DatadetailpaymentController::class, 'index'])->name('data.detail')->middleware('auth');

Route::put('/payment/validate/{id}', [DatadetailpaymentController::class, 'update'])->name('payment.update')->middleware('auth');

//data edit payment
Route::get('/payment/{id}/edit', [DatadetailpaymentController::class, 'edit'])->name('payment.edit');


//payment admin
Route::get('/paymentadmin', [PaymentadminController::class, 'index'])->name('admin.payment')->middleware('auth');


//data mitra
Route::get('/datamitra', [DatamitraController::class, 'index'])->name('data.mitra')->middleware('auth');
Route::delete('/mitra_delete{id}', [Datamitracontroller::class, 'destroy'])->name('mitra_delete');
Route::put('/update_mitra{id}', [DatamitraController::class, 'update'])->name('update_mitra');
Route::post('/masuk', [DatamitraController::class, 'store'])->name('masuk');

//data wilayah
Route::get('/datawilayah', [DatawilayahController::class, 'index'])->name('data.wilayah')->middleware('auth');
Route::delete('/wilayah_delete{id}', [Datawilayahcontroller::class, 'destroy'])->name('wilayah_delete');
Route::put('/update_wilayah{id}', [DatawilayahController::class, 'update'])->name('update_wilayah');
Route::post('/gowlet', [DatawilayahController::class, 'store'])->name('gow.let');

//data jenis pajak
Route::get('/datajenispajak', [DatajenispajakController::class, 'index'])->name('data.jenispajak')->middleware('auth');
Route::delete('/datajenispajak_delete{id}', [DatajenispajakController::class, 'destroy'])->name('datajenispajak_delete');
Route::put('/update_datajenispajak{id}', [DatajenispajakController::class, 'update'])->name('update_datajenispajak');
Route::post('/datapajak', [DatajenispajakController::class, 'store'])->name('datapajak');

//data jenis transaksi
Route::get('/datajenistransaksi', [DatajenistransaksiController::class, 'index'])->name('data.jenistransaksi')->middleware('auth');
Route::delete('/datajenistransaksi_delete{id}', [DatajenistransaksiController::class, 'destroy'])->name('datajenistransaksi_delete');
Route::put('/update_datajenistransaksi{id}', [DatajenistransaksiController::class, 'update'])->name('update_datajenistransaksi');
Route::post('/datatransaksi', [DatajenistransaksiController::class, 'store'])->name('datatransaksi');

//data pengajuan integrasi
Route::get('/datapengajuanintegrasi', [DatapengajuanintegrasiController::class, 'index'])->name('data.pengajuanintegrasi')->middleware('auth');
Route::delete('/datapengajuanintegrasi_delete{id}', [DatapengajuanintegrasiController::class, 'destroy'])->name('datapengajuanintegrasi_delete');
Route::put('/update_datapengajuanintegrasi{id}', [DatapengajuanintegrasiController::class, 'update'])->name('update_datapengajuanintegrasi');
Route::post('/datapengajuan', [DatapengajuanintegrasiController::class, 'store'])->name('datapengajuan');

//Pegguna baru
Route::get('/penggunabaru', [PenggunabaruController::class, 'index'])->name('pengguna.baru')->middleware('auth');
Route::delete('/datapenggunabaru_delete{id}',[PenggunabaruController::class, 'destroy'])->name('datapenggunabaru_delete');

//UserWilayah
Route::get('/userwilayah', [UserwilayahController::class, 'index'])->name('user.wilayah')->middleware('auth');
Route::post('/gow', [UserwilayahController::class,'store'])->name('gow')->middleware('auth');
Route::post('/assign-wilayah', [UserwilayahController::class, 'assignWilayah'])->name('assign.wilayah');
Route::get('/get-wilayah-by-provinsi', [UserwilayahController::class, 'getWilayahByProv'])->name('getWilayahByProv');


//data provinsi
Route::get('/dataprovinsi',[ProvinsiController::class,'index'])->name('data.provinsi')->middleware('auth');
Route::post('/godaw',[ProvinsiController::class,'store'])->name('godaw')->middleware('auth');
// Route::get('dataprovinsi',[ProvinsiController::class,'index'])->name('data.provinsi')->middleware('auth');
//data user detail
Route::get('/detailpengguna', [PenggunadetailController::class, 'index'])->name('data.detailpengguna')->middleware('auth');


























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










