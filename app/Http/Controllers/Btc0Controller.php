<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Btc0Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentmba = PaymentMba::orderBy('updated_at', 'desc')
        ->orderBy('created_at', 'desc')
        ->with('mitraAgg') // Tambahkan relasi mitraAgg agar lebih efisien
        ->get()
        ->map(function ($item) {
            $jenisPajakIds = explode(',', $item->jenis_pajak_id);
            $item->jenis_pajak_nama = JenisPajak::whereIn('id', $jenisPajakIds)
                ->pluck('nama_jenis_pajak')
                ->implode(', ');

            // Tambahkan nama mitra dari mitraAgg yang memiliki flag_agg = 1
            $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';

            return $item;
        });

    $user = Auth::user();

    $totalpengajuanPerAM = User::leftJoin('payment_mba', 'users.id', '=', 'payment_mba.user_id')
        ->selectRaw('users.id as am_id, users.username, COUNT(payment_mba.id) as total_pengajuan')
        ->whereIn('users.id', [2, 3, 4, 5, 6]) // Hanya AM dengan ID tertentu
        ->groupBy('users.id', 'users.username')
        ->get();




        return view('admin2.homeadmin0', compact('paymentmba',  'user', 'totalpengajuanPerAM'));
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
