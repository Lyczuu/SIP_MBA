<?php

namespace App\Http\Controllers;

use App\Models\jenis_pajak;
use App\Models\jenis_transaksi;
use App\Models\User;
use App\Models\mitra;
use App\Models\wilayah;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Models\paymentmbafee;


class DashboardController extends Controller
{
    public function index()
    {

        $paymentmba= paymentmba::all();
        $paymentmbafee = paymentmbafee::all();
        $User = User::all();
        $mitra = mitra::all();
        $wilayah = wilayah::all();
        $jenis_transaksi = jenis_transaksi::all();
        $jenis_pajak = jenis_pajak::all();
        return view('admin.dashboard', compact('paymentmba', 'paymentmbafee'));
          // Ambil semua data paymentmba
    $paymentmba = PaymentMba::with(['user', 'mitra', 'wilayah', 'jenis_transaksi', 'fees'])->get();

    // Pisahkan data yang memiliki fee admin dan yang tidak
    $paymentmba = $paymentmba->filter(function ($item) {
        return $item->fees && $item->fees->total_fee !== null;
    });

    $paymentmbafee = $paymentmba->filter(function ($item) {
        return !$item->fees || $item->fees->total_fee === null;
    });

    // Kirim data yang sudah difilter ke view
    return view('admin.dashboard', [
        'paymentmba' => $paymentmba,
        'paymentmbafee' => $paymentmbafee,
    ]);
    }
}
