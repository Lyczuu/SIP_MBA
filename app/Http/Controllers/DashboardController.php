<?php

namespace App\Http\Controllers;

use App\Models\jenispajak;
use App\Models\paymentmba;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function index()
    {
        $allJenisPajak = jenispajak::pluck('nama_jenis_pajak', 'id'); // [id => nama]

        $paymentmba = PaymentMba::all()->map(function ($item) use ($allJenisPajak) {
            $jenisPajakIds = array_filter(array_map('trim', explode(',', $item->jenis_pajak_id ?? '')));
            $item->jenis_pajak_nama = collect($jenisPajakIds)
                ->map(fn($id) => $allJenisPajak[$id] ?? null)
                ->filter()
                ->implode(', ') ?: '-';
            return $item;
        });

        $userId = Auth::id(); // Ambil ID user yang sedang login
        $totalpengajuan = PaymentMBA::where('user_id', $userId)->count();
        // Hitung total berdasarkan mitra_agg = "AM Kerja Sama"
        $totalMitraAgg = PaymentMBA::where('mitra_agg')->count();
        return view('admin.dashboard', compact('paymentmba', 'totalpengajuan','totalMitraAgg'));
    }
}
