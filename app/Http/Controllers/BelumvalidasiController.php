<?php

namespace App\Http\Controllers;

use App\Models\fees;
use App\Models\mitra;
use App\Models\wilayah;
use App\Models\paymentmba;
use App\Models\jenis_pajak;
use Illuminate\Http\Request;
use App\Models\belumvalidasi;
use App\Models\jenis_transaksi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BelumvalidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentmba = paymentmba::all()->map(function ($item) {
            $jenisPajakIds = explode(',', $item->jenis_pajak_id);
            $item->jenis_pajak_nama = jenis_pajak::whereIn('id', $jenisPajakIds)->pluck('nama_jenis_pajak')->implode(', ');
            return $item;
        });
        $user = Auth::user();
        $paymentmba = PaymentMBA::where('user_id', $user->id)->get();

        return view('admin.belumvalidasi', compact('paymentmba'));
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
    public function show(belumvalidasi $belumvalidasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(belumvalidasi $belumvalidasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, belumvalidasi $belumvalidasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(belumvalidasi $belumvalidasi)
    {
        //
    }
}
