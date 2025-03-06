<?php

namespace App\Http\Controllers;

use App\Models\jenispajak;
use App\Models\paymentmba;


class NofeeaditolakController extends Controller
{
    public function index  ()
    {
        $allJenisPajak = jenispajak::pluck('nama_jenis_pajak', 'id');

        $paymentmba = paymentmba::with(['ditolak.User', 'pengajuanIntegrasi', 'mitra', 'fees','mitraAgg'])->get()->map(function ($item) use ($allJenisPajak) {
            // Ubah jenis_pajak_id (string "1,2,3") menjadi array [1, 2, 3]
            $jenisPajakIds = array_filter(array_map('trim', explode(',', $item->jenis_pajak_id ?? '')));

            // Ambil nama jenis pajak berdasarkan ID
            $item->jenis_pajak_nama = collect($jenisPajakIds)
                ->map(fn($id) => $allJenisPajak[$id] ?? null)
                ->filter()
                ->implode(', ') ?: '-';

            $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';
            // Tambahkan properti alasan_penolakan dari relasi ditolak
            $item->alasan_penolakan = $item->ditolak?->alasan_penolakan ?? '-';
            $item->ditolak_oleh = $item->ditolak?->User?->username ?? '-';

            // Tambahkan properti nama_pengajuan_integrasi dari relasi pengajuanIntegrasi
            $item->nama_pengajuan_integrasi = $item->pengajuanIntegrasi?->nama_pengajuan_integrasi ?? '-';
            $item->nama_mitra = $item->mitra?->nama_mitra ?? '-';
            $item->total_fee = $item->fees?->total_fee ?? '-';
            $item->fee_mba = $item->fees?->fee_mba ?? '-';
            $item->fee_mitra = $item->fees?->fee_mitra ?? '-';

            return $item;
        });
        return view('admin2.nofeeditolak', compact('paymentmba'));
    }
}
