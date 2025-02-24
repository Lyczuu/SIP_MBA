<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\mitra;
use App\Models\wilayah;
use App\Models\paymentmba;
use App\Models\jenis_pajak;
use Illuminate\Http\Request;
use App\Models\paymentmbafee;
use App\Models\jenis_transaksi;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{

    public function index()
    {
        $paymentmba = paymentmba::all()->map(function ($item) {
            $jenisPajakIds = explode(',', $item->jenis_pajak_id);
            $item->jenis_pajak_nama = jenis_pajak::whereIn('id', $jenisPajakIds)->pluck('nama_jenis_pajak')->implode(', ');
            return $item;
        });
        $user = Auth::user();
        $paymentmba = PaymentMBA::where('user_id', $user->id)->get();

        return view('admin.dashboard',compact('paymentmba'));
    }

}
