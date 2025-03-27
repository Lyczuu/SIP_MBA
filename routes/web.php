<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DitolakController;
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
use App\Http\Controllers\AdmindashboardController;
use App\Http\Controllers\DatajenispajakController;
use App\Http\Controllers\JenispengajuanController;
use App\Http\Controllers\NofeeaditerimaController;
use App\Http\Controllers\PenggunadetailController;
use App\Http\Controllers\FeebelumvalidasiController;
use App\Http\Controllers\FeeabelumvalidasiController;
use App\Http\Controllers\DatajenistransaksiController;
use App\Http\Controllers\NofeebelumvalidasiController;
use App\Http\Controllers\NofeeabelumvalidasiController;
use App\Http\Controllers\DatapengajuanintegrasiController;
use App\Http\Controllers\RoleController;
use App\Models\provinsi;

Route::get('/', function () {
    return view('auth/login');
});

//Routing awal
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'cek_login'])->name('cek_login');
Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home');


//routing am

//halaman dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

//halaman pengajuan
Route::get('/admin/payment_mba_admin', [PaymentmbaController::class, 'index'])->name('payment_mba_admin');

//form pengajuan fee admin
Route::post('/jukan', [PaymentmbaController::class, 'store'])->name('jukan');

//jenis pengajuan
Route::get('/admin/pengajuan', [JenispengajuanController::class, 'index'])->name('admin.pengajuan');


//halaman fee admin
Route::get('/feeditolak', [FeeditolakController::class, 'index'])->name('fee.ditolak')->middleware('auth');
Route::get('/feediterima', [FeediterimaController::class, 'index'])->name('fee.diterima')->middleware('auth');
Route::get('/feebelumvalidasi', [FeebelumvalidasiController::class, 'index'])->name('fee.belumvalidasi')->middleware('auth');


//di tolak am
Route::get('/ditolak', [DitolakController::class, 'index'])->name('ditolak')->middleware('auth');

//update form pengajuan
Route::put('/ditolak/{id}', [DitolakController::class, 'update'])->name('update.ditolak');

//diterima
Route::get('/diterima', [DiterimaController::class, 'index'])->name('diterima')->middleware('auth');

//di proses
Route::get('/belumvalidasi', [BelumvalidasiController::class, 'index'])->name('belumvalidasi')->middleware('auth');






//payment mba no fee admin
Route::get('/admin/payment_mba_no_fee_admin', [PaymentmbafeeController::class, 'index'])->name('payment_mba_no_fee_admin');

//form pengajuan no fee
Route::post('/sok', [PaymentmbafeeController::class, 'store'])->name('sok');


// halaman no fee admin {tabel}
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




// routing profil {admin & am}

Route::get('/admin/profil', [ProfilController::class, 'index'])->name('admin.profil');
Route::put('/profile/update', [ProfilController::class, 'update'])->name('profile.update');




Route::put('/update_nofee{id}', [paymentmbafeeController::class, 'update'])->name('update_nofee');









//routing api admin

Route::get('/api/get-payment-admin', function (Request $request) {
    // Pastikan user sudah login
    $user = Auth::user();

    // Periksa apakah user memiliki role Admin (role_id = 1)
    if (!$user || $user->role_id != 1) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    // Ambil data untuk feead (jenis_pengajuan = 1)
    $ditolak_feead = DB::table('payment_mba')
        ->where('status', 1)
        ->where('jenis_pengajuan', 1)
        ->count();

    $diterima_feead = DB::table('payment_mba')
        ->where('status', 2)
        ->where('jenis_pengajuan', 1)
        ->count();

    $belum_divalidasifeead = DB::table('payment_mba')
        ->where('status', 0)
        ->where('jenis_pengajuan', 1)
        ->count();

    // Ambil data untuk nofeead (jenis_pengajuan = 2)
    $ditolak_nofeead = DB::table('payment_mba')
        ->where('status', 1)
        ->where('jenis_pengajuan', 2)
        ->count();

    $diterima_nofeead = DB::table('payment_mba')
        ->where('status', 2)
        ->where('jenis_pengajuan', 2)
        ->count();

    $belum_divalidasinofeead = DB::table('payment_mba')
        ->where('status', 0)
        ->where('jenis_pengajuan', 2)
        ->count();

    return response()->json([
        'ditolak_feead' => $ditolak_feead,
        'diterima_feead' => $diterima_feead,
        'belum_divalidasifeead' => $belum_divalidasifeead,
        'ditolak_nofeead' => $ditolak_nofeead,
        'diterima_nofeead' => $diterima_nofeead,
        'belum_divalidasinofeead' => $belum_divalidasinofeead
    ]);
});



//routing api am untuk menghitung data di tabel utama

Route::get('/api/get-payment-im', function (Request $request) {
    $userId = Auth::id(); // Ambil ID user yang sedang login

    $ditolak_feeam = DB::table('payment_mba')
        ->where('status', 1)
        ->where('jenis_pengajuan', 1)
        ->where('user_id', $userId)
        ->count();

    $diterima_feeam = DB::table('payment_mba')
        ->where('status', 2)
        ->where('jenis_pengajuan', 1)
        ->where('user_id', $userId)
        ->count();

    $belum_divalidasifeeam = DB::table('payment_mba')
        ->where('status', 0)
        ->where('jenis_pengajuan', 1)
        ->where('user_id', $userId)
        ->count();

    return response()->json([
        'ditolak_feeam' => $ditolak_feeam,
        'diterima_feeam' => $diterima_feeam,
        'belum_divalidasifeeam' => $belum_divalidasifeeam
    ]);
});

Route::get('/api/get-payment-am', function (Request $request) {
    $userId = Auth::id(); // Ambil ID user yang sedang login

    $ditolak_nofeeam = DB::table('payment_mba')
        ->where('status', 1)
        ->where('jenis_pengajuan', 2)
        ->where('user_id', $userId)
        ->count();

    $diterima_nofeeam = DB::table('payment_mba')
        ->where('status', 2)
        ->where('jenis_pengajuan', 2)
        ->where('user_id', $userId)
        ->count();

    $belum_divalidasinofeeam = DB::table('payment_mba')
        ->where('status', 0)
        ->where('jenis_pengajuan', 2)
        ->where('user_id', $userId)
        ->count();

    return response()->json([
        'ditolak_nofeeam' => $ditolak_nofeeam,
        'diterima_nofeeam' => $diterima_nofeeam,
        'belum_divalidasinofeeam' => $belum_divalidasinofeeam
    ]);
});






//routing admin

//halaman utama
Route::get('/utama', [AdmindashboardController::class, 'index'])->name('admin.utama');

//data user detail
Route::get('/detailpengguna', [PenggunadetailController::class, 'index'])->name('data.detailpengguna')->middleware('auth');

//Role
Route::get('/role',[RoleController::class, 'index'])->name('data.role')->middleware('auth');
Route::put('/update_role{id}', [RoleController::class, 'update'])->name('update_role');
Route::delete('/role_delete{id}', [RoleController::class, 'destroy'])->name('role_delete');
Route::post('/role', [RoleController::class, 'store'])->name('role');
//data dijukan
Route::get('/datadiajukan', [DatadiajukanController::class, 'index'])->name('admin.datadiajukan')->middleware('auth');
Route::put('/update_diajukan{id}', [DatadiajukanController::class, 'update'])->name('update.dijaukan');
//ajax diajukan
Route::get('/get-latest-payments', [DatadiajukanController::class, 'getLatestPayments'])->name('get.latest.payments');


//data ditolak
Route::get('/dataditolak', [DataditolakController::class, 'index'])->name('data.ditolak')->middleware('auth');

//data disetujui
Route::get('/datadisetujui', [DatadisetujuiController::class, 'index'])->name('data.disetujui')->middleware('auth');

//data mitra
Route::get('/datamitra', [DatamitraController::class, 'index'])->name('data.mitra')->middleware('auth');
Route::delete('/mitra_delete{id}', [Datamitracontroller::class, 'destroy'])->name('mitra_delete');
Route::put('/update_mitra{id}', [DatamitraController::class, 'update'])->name('update_mitra');
Route::post('/masuk', [DatamitraController::class, 'store'])->name('masuk');
//restore data mitra
Route::get('/mitra/restore/{id}', [DatamitraController::class, 'restore']);

//data wilayah
Route::get('/datawilayah', [DatawilayahController::class, 'index'])->name('data.wilayah')->middleware('auth');
Route::delete('/wilayah_delete{id}', [Datawilayahcontroller::class, 'destroy'])->name('wilayah_delete');
Route::put('/update_wilayah{id}', [DatawilayahController::class, 'update'])->name('update_wilayah');
Route::post('/gowlet', [DatawilayahController::class, 'store'])->name('gow.let');
//restore data
Route::get('/wilayah/restore/{id}', [DatawilayahController::class, 'restore']);

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
//restore data
Route::get('/provinsi/restore/{id}', [ProvinsiController::class, 'restore']);

//feeadmin
Route::get('/feeabelumvalidasi',[FeeabelumvalidasiController::class, 'index'])->name('feea.belumvalidasi');
Route::get('/feeaditolak',[FeeaditolakController::class, 'index'])->name('feea.ditolak');
Route::get('/feeaditerima',[FeeaditerimaController::class, 'index'])->name('feea.diterima');

//nofee
Route::get('/nofeeabelumvalidasi', [NofeeabelumvalidasiController::class, 'index'])->name('nofeea.belumvalidasi');
Route::get('/nofeeaditolak', [NofeeaditolakController::class, 'index'])->name('nofeea.ditolak');
Route::get('/nofeeaditerima', [NofeeaditerimaController::class, 'index'])->name('nofeea.diterima');

