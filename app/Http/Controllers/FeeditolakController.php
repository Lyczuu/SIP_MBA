<?php

namespace App\Http\Controllers;

use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeeditolakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userId = Auth::id(); // Mendapatkan ID user yang sedang login
        $allJenisPajak = JenisPajak::pluck('nama_jenis_pajak', 'id');

        $paymentmba = PaymentMba::with([
            'ditolak.User',
            'pengajuanIntegrasi',
            'mitra',
            'fees',
            'mitraAgg'
        ])
            ->where('user_id', $userId) // Filter berdasarkan user yang login
            ->get()
            ->map(function ($item) use ($allJenisPajak) {
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

                // Tambahkan properti tambahan dari relasi lain
                $item->nama_pengajuan_integrasi = $item->pengajuanIntegrasi?->nama_pengajuan_integrasi ?? '-';
                $item->nama_mitra = $item->mitra?->nama_mitra ?? '-';
                $item->total_fee = $item->fees?->total_fee ?? '-';
                $item->fee_mba = $item->fees?->fee_mba ?? '-';
                $item->fee_mitra = $item->fees?->fee_mitra ?? '-';

                return $item;
            });

        return view('admin.feeditolak', compact('paymentmba'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
