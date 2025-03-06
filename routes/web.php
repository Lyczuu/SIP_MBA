<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Btc0Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ditolakController;
use App\Http\Controllers\DiterimaController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatamitraController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FeeditolakController;
use App\Http\Controllers\PaymentmbaController;
use App\Http\Controllers\DataditolakController;
use App\Http\Controllers\DatawilayahController;
use App\Http\Controllers\FeeaditolakController;
use App\Http\Controllers\FeediterimaController;
use App\Http\Controllers\UserwilayahController;
use App\Http\Controllers\DatadiajukanController;
use App\Http\Controllers\FeeaditerimaController;
use App\Http\Controllers\NofeeditolakController;
use App\Http\Controllers\PenggunabaruController;
use App\Http\Controllers\BelumvalidasiController;
use App\Http\Controllers\DatadisetujuiController;
use App\Http\Controllers\NofeeaditolakController;
use App\Http\Controllers\NofeediterimaController;
use App\Http\Controllers\PaymentmbafeeController;
use App\Http\Controllers\DatajenispajakController;
use App\Http\Controllers\jenispengajuanController;
use App\Http\Controllers\NofeeaditerimaController;
use App\Http\Controllers\PenggunadetailController;
use App\Http\Controllers\FeebelumvalidasiController;
use App\Http\Controllers\DatadetailpaymentController;
use App\Http\Controllers\FeeabelumvalidasiController;
use App\Http\Controllers\DatajenistransaksiController;
use App\Http\Controllers\NofeebelumvalidasiController;
use App\Http\Controllers\NofeeabelumvalidasiController;
use App\Http\Controllers\DatapengajuanintegrasiController;


Route::get('/', function () {
    return view('auth/login');
});

//Routing awal
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'cek_login'])->name('cek_login');
Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home');


//payment mba fee admin
Route::get('/admin/payment_mba_admin', [PaymentmbaController::class, 'index'])->name('payment_mba_admin');
Route::post('/jukan', [PaymentmbaController::class, 'store'])->name('jukan');
Route::get('/success', function () { return view('success'); })->name('success.page');
Route::get('/generate-Kode-pengajuan', [PaymentmbaController::class, 'generateKodepengajuan']);
//fee admin
Route::get('/feeditolak', [FeeditolakController::class, 'index'])->name('fee.ditolak')->middleware('auth');
Route::get('/feediterima', [FeediterimaController::class, 'index'])->name('fee.diterima')->middleware('auth');
Route::get('/feebelumvalidasi', [FeebelumvalidasiController::class, 'index'])->name('fee.belumvalidasi')->middleware('auth');


//di tolak
Route::get('/ditolak', [ditolakController::class, 'index'])->name('ditolak')->middleware('auth');

Route::put('/ditolak/{id}', [ditolakController::class, 'update'])->name('ditolak.update');

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



//cetakexcel
//diterima hak AM
Route::post('/payment/exportAM', [DiterimaController::class, 'export'])->name('payment.exportAM');
//diterima hak admin
Route::post('/payment/exportAdmin', [DatadisetujuiController::class, 'export'])->name('payment.exportAdmin');




//jenis pengajuan
Route::get('/admin/pengajuan', [jenispengajuanController::class, 'index'])->name('admin.pengajuan');



//dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// Route::match(['get', 'post'], '/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

Route::get('/admin/profil', [ProfilController::class, 'index'])->name('admin.profil');
Route::put('/profile/update', [ProfilController::class, 'update'])->name('profile.update');


// Route::get('/generate-kode-pengajuan', [PaymentmbaController::class, 'generateKodePengajuan']);

Route::put('/update_nofee{id}', [paymentmbafeeController::class, 'update'])->name('update_nofee');
// end Rouitng awal


//api untuk notif

// Hitung jumlah berdasarkan status dan jenis_pengajuan
Route::get('/api/get-payment-count', function () {
    $ditolak_feeadmin = DB::table('payment_mba')
        ->where('status', 1)
        ->where('jenis_pengajuan', 1)
        ->count();

    $diterima_feeadmin = DB::table('payment_mba')
        ->where('status', 2)
        ->where('jenis_pengajuan', 1)
        ->count();


    $belum_divalidasi = DB::table('payment_mba')
        ->where('status', 0)
        ->where('jenis_pengajuan', 1)
        ->count();

    return response()->json([
        'ditolak_feeadmin' => $ditolak_feeadmin,
        'diterima_feeadmin' => $diterima_feeadmin,
        'belum_divalidasi' => $belum_divalidasi
    ]);
});

Route::get('/api/get-payment-list', function () {
    $ditolak_feeadmin = DB::table('payment_mba')
        ->where('status', 1)
        ->where('jenis_pengajuan', 2)
        ->count();

    $diterima_feeadmin = DB::table('payment_mba')
        ->where('status', 2)
        ->where('jenis_pengajuan', 2)
        ->count();


    $belum_divalidasi = DB::table('payment_mba')
        ->where('status', 0)
        ->where('jenis_pengajuan', 2)
        ->count();

    return response()->json([
        'ditolak_feeadmin' => $ditolak_feeadmin,
        'diterima_feeadmin' => $diterima_feeadmin,
        'belum_divalidasi' => $belum_divalidasi
    ]);
});



//notif untuk am

Route::get('/api/get-payment-im', function (Request $request) {
    $userId = Auth::id(); // Ambil ID user yang sedang login

    $ditolak_feeadmin = DB::table('payment_mba')
        ->where('status', 1)
        ->where('jenis_pengajuan', 1)
        ->where('user_id', $userId)
        ->count();

    $diterima_feeadmin = DB::table('payment_mba')
        ->where('status', 2)
        ->where('jenis_pengajuan', 1)
        ->where('user_id', $userId)
        ->count();

    $belum_divalidasi = DB::table('payment_mba')
        ->where('status', 0)
        ->where('jenis_pengajuan', 1)
        ->where('user_id', $userId)
        ->count();

    return response()->json([
        'ditolak_feeadmin' => $ditolak_feeadmin,
        'diterima_feeadmin' => $diterima_feeadmin,
        'belum_divalidasi' => $belum_divalidasi
    ]);
});

Route::get('/api/get-payment-am', function (Request $request) {
    $userId = Auth::id(); // Ambil ID user yang sedang login

    $ditolak_feeadmin = DB::table('payment_mba')
        ->where('status', 1)
        ->where('jenis_pengajuan', 2)
        ->where('user_id', $userId)
        ->count();

    $diterima_feeadmin = DB::table('payment_mba')
        ->where('status', 2)
        ->where('jenis_pengajuan', 2)
        ->where('user_id', $userId)
        ->count();

    $belum_divalidasi = DB::table('payment_mba')
        ->where('status', 0)
        ->where('jenis_pengajuan', 2)
        ->where('user_id', $userId)
        ->count();

    return response()->json([
        'ditolak_feeadmin' => $ditolak_feeadmin,
        'diterima_feeadmin' => $diterima_feeadmin,
        'belum_divalidasi' => $belum_divalidasi
    ]);
});



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


//filter bulan dan tahun
// Route::get('/pengajuan/filter', [Btc0Controller::class, 'index'])->name('pengajuan.filter');


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
Route::post('/grit', [PenggunabaruController::class,'store'])->name('grit')->middleware('auth');
Route::put('/update_pengguna{id}', [PenggunabaruController::class, 'update'])->name('update_pengguna');
Route::delete('/datapenggunabaru_delete{id}',[PenggunabaruController::class, 'destroy'])->name('datapenggunabaru_delete');

//UserWilayah
Route::get('/userwilayah', [UserwilayahController::class, 'index'])->name('user.wilayah')->middleware('auth');
Route::post('/gow', [UserwilayahController::class,'store'])->name('data.gow');

//data provinsi
Route::get('/dataprovinsi',[ProvinsiController::class,'index'])->name('data.provinsi')->middleware('auth');
Route::post('/godaw',[ProvinsiController::class,'store'])->name('godaw')->middleware('auth');
Route::put('/update_provinsi{id}', [ProvinsiController::class, 'update'])->name('update_provinsi');
Route::delete('/dataprovinsi_delete{id}', [ProvinsiController::class, 'destroy'])->name('dataprovinsi_delete');


//feeadmin
Route::get('/feeabelumvalidasi',[FeeabelumvalidasiController::class, 'index'])->name('feea.belumvalidasi');
Route::get('/feeaditolak',[FeeaditolakController::class, 'index'])->name('feea.ditolak');
Route::get('/feeaditerima',[FeeaditerimaController::class, 'index'])->name('feea.diterima');

//nofee
Route::get('/nofeeabelumvalidasi', [NofeeabelumvalidasiController::class, 'index'])->name('nofeea.belumvalidasi');
Route::get('/nofeeaditolak', [NofeeaditolakController::class, 'index'])->name('nofeea.ditolak');
Route::get('/nofeeaditerima', [NofeeaditerimaController::class, 'index'])->name('nofeea.diterima');

//data user detail
Route::get('/detailpengguna', [PenggunadetailController::class, 'index'])->name('data.detailpengguna')->middleware('auth');
