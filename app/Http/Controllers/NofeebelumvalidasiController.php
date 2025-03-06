<?php

namespace App\Http\Controllers;

use App\Models\jenispajak;
use App\Models\paymentmba;
use App\Models\jenis_pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NofeebelumvalidasiController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Ambil daftar semua jenis pajak dalam bentuk [id => nama]
        $allJenisPajak = JenisPajak::pluck('nama_jenis_pajak', 'id');

        // Ambil hanya data yang sesuai dengan user yang login
        $paymentmba = PaymentMBA::where('user_id', $userId)
            ->with(['user', 'mitra', 'wilayah', 'jenis_transaksi', 'mitraAgg']) // Tambah relasi mitraAgg
            ->get()
            ->map(function ($item) use ($allJenisPajak) {
                // Mengonversi jenis_pajak_id (format CSV) menjadi array
                $jenisPajakIds = array_filter(array_map('trim', explode(',', $item->jenis_pajak_id ?? '')));

                // Mapping ID jenis pajak ke nama
                $item->jenis_pajak_nama = collect($jenisPajakIds)
                    ->map(fn($id) => $allJenisPajak[$id] ?? null)
                    ->filter()
                    ->implode(', ') ?: '-';

                // Menambahkan nama_mitra dari mitraAgg yang memiliki flag_agg = 1
                $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';

                return $item;
            });

        return view('admin.nofeebelumvalidasi',compact('paymentmba'));
    }
}
