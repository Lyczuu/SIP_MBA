<?php

namespace App\Http\Controllers;

use App\Models\jenispajak;
use App\Models\paymentmba;
use App\Models\dataditolak;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class DataditolakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allJenisPajak = JenisPajak::pluck('nama_jenis_pajak', 'id');

        $paymentmba = PaymentMba::with(['ditolak.User', 'pengajuanIntegrasi', 'mitra', 'fees','mitraAgg'])->get()->map(function ($item) use ($allJenisPajak) {
            // Ubah jenis_pajak_id (string "1,2,3") menjadi array [1, 2, 3]
            $jenisPajakIds = array_filter(array_map('trim', explode(',', $item->jenis_pajak_id ?? '')));

            // Ambil nama jenis pajak berdasarkan ID
            $item->jenis_pajak_nama = collect($jenisPajakIds)
                ->map(fn($id) => $allJenisPajak[$id] ?? null)
                ->filter()
                ->implode(', ') ?: '-';

            // Tambahkan properti alasan_penolakan dari relasi ditolak
            $item->alasan_penolakan = $item->ditolak?->alasan_penolakan ?? '-';
            $item->ditolak_oleh = $item->ditolak?->User?->username ?? '-';


            $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';
            // Tambahkan properti nama_pengajuan_integrasi dari relasi pengajuanIntegrasi
            $item->nama_pengajuan_integrasi = $item->pengajuanIntegrasi?->nama_pengajuan_integrasi ?? '-';
            $item->nama_mitra = $item->mitra?->nama_mitra ?? '-';
            $item->total_fee = $item->fees?->total_fee ?? '-';
            $item->fee_mba = $item->fees?->fee_mba ?? '-';
            $item->fee_mitra = $item->fees?->fee_mitra ?? '-';

            return $item;
        });
        return view('admin2.dataditolak', compact('paymentmba'));


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
    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return view('admin2.dataditolak', ['user' => $user]);
        } else {
            return abort(404, "User tidak ditemukan");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(dataditolak $dataditolak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, dataditolak $dataditolak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dataditolak $dataditolak)
    {
        //
    }
}
