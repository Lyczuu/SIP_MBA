<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ditolak;
use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function index()
    {

        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Ambil daftar semua jenis pajak dalam bentuk [id => nama]
        $allJenisPajak = JenisPajak::pluck('nama_jenis_pajak', 'id');

        // Ambil hanya data yang sesuai dengan user yang login, urutkan dari yang terbaru
        $paymentmba = PaymentMBA::where('user_id', $userId)
            ->with(['user', 'mitra', 'wilayah', 'jenis_transaksi', 'mitraAgg']) // Tambahkan relasi mitraAgg
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc') // Urutkan data berdasarkan waktu dibuat (paling baru di atas)
            ->get()
            ->map(function ($item) use ($allJenisPajak) {
                // Mengonversi jenis_pajak_id (format CSV) menjadi array
                $jenisPajakIds = array_filter(array_map('trim', explode(',', $item->jenis_pajak_id ?? '')));

                // Mapping ID jenis pajak ke nama
                $item->jenis_pajak_nama = collect($jenisPajakIds)
                    ->map(fn($id) => $allJenisPajak[$id] ?? null)
                    ->filter()
                    ->implode(', ') ?: '-';

                // Tambahkan nama mitra dari mitraAgg yang memiliki flag_agg = 1
                $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';

                return $item;
            });

        // Hitung total pengajuan berdasarkan user yang login
        $totalpengajuan = PaymentMBA::where('user_id', $userId)->count();

        // Hitung total semua pengajuan dari semua user
        $totalSemuaPengajuan = PaymentMBA::count();

        // tidak terjadi pembagian dengan nol
        $persentasePengajuan = $totalSemuaPengajuan > 0
            ? ($totalpengajuan / $totalSemuaPengajuan) * 100
            : 0;

        $totalMitraAgg = PaymentMBA::where('user_id', $userId) // Filter berdasarkan user yang login
            ->whereNotNull('mitra_agg') // Pastikan mitra_agg tidak NULL
            ->where('mitra_agg', '!=', '') // Pastikan mitra_agg tidak kosong
            ->whereRaw("mitra_agg REGEXP '^[0-9]+$'") // Hanya angka yang valid
            ->count();



        // $rejectedCount = PaymentMBA::where('status', 1)
        //     ->where('user_id', $userId) // Hanya data milik user yang login
        //     ->count();



        //     $rejectedMessages = Ditolak::with('ditolakOleh') // Load relasi admin untuk ambil namanya
        //     ->whereHas('paymentMba', function ($query) use ($userId) {
        //         $query->where('user_id', $userId);
        //     })
        //     ->latest()
        //     ->limit(3) // Ambil 3 data terbaru
        //     ->get();

        return view('admin.dashboard', compact('paymentmba', 'totalpengajuan', 'totalMitraAgg', 'persentasePengajuan'));
    }
}
