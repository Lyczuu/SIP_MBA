<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        // Hitung total mitra_agg yang berisi angka
        $totalMitraAgg = PaymentMBA::whereNotNull('mitra_agg')
            ->whereRaw("mitra_agg REGEXP '^[0-9]+$'")
            ->count();

        // Ambil mitra_agg dari payment_mba berdasarkan user yang login
        $mitraAgg = PaymentMba::where('user_id', $userId)->value('mitra_agg');

        return view('admin.dashboard', compact('paymentmba', 'totalpengajuan', 'totalMitraAgg', 'mitraAgg'));
    }
}
