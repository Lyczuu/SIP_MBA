<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdmindashboardController extends Controller
{
    public function index()
    {
        $paymentmba = paymentmba::orderBy('updated_at', 'desc')
        ->orderBy('created_at', 'desc')
        ->with('mitraAgg') // Tambahkan relasi mitraAgg agar lebih efisien
        ->get()
        ->map(function ($item) {
            $jenisPajakIds = explode(',', $item->jenis_pajak_id);
            $item->jenis_pajak_nama = jenispajak::whereIn('id', $jenisPajakIds)
                ->pluck('nama_jenis_pajak')
                ->implode(', ');

            // Tambahkan nama mitra dari mitraAgg yang memiliki flag_agg = 1
            $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';

            return $item;
        });

    $user = Auth::user();

    $totalPengajuanPerAM = User::leftJoin('payment_mba', 'users.id', '=', 'payment_mba.user_id')
    ->whereIn('users.id', [2, 3, 4, 5, 6]) // Hanya AM dengan ID tertentu
    ->select('users.id as am_id', 'users.username', DB::raw('COUNT(payment_mba.id) as total_pengajuan'))
    ->groupBy('users.id', 'users.username')
    ->get();



        return view('admin2.homeadmin0', compact('paymentmba',  'user', 'totalPengajuanPerAM'));
    }
}
