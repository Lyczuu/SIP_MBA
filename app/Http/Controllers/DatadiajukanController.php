<?php

namespace App\Http\Controllers;


use App\Models\ditolak;
use App\Models\jenispajak;
use App\Models\paymentmba;
use App\Models\datadiajukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatadiajukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentmba = PaymentMba::all()->map(function ($item) {
            $jenisPajakIds = explode(',', $item->jenis_pajak_id);
            $item->jenis_pajak_nama = JenisPajak::whereIn('id', $jenisPajakIds)->pluck('nama_jenis_pajak')->implode(', ');

            // Tambahkan nama mitra dari mitraAgg yang memiliki flag_agg = 1
            $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';

            return $item;
        });

        $ditolak = ditolak::with('user')->get();
        $user = Auth::user();
        $paymentmbafee = PaymentMBA::where('user_id', $user->id)->get();

        return view('admin2.datadiajukan', compact('paymentmba', 'user'));

        // // Kirim data yang sudah difilter ke view
        // return view('admin2.datadiajukan', [
        //     'paymentmba' => $paymentmba,
        //     'paymentmbafee' => $paymentmbafee,
        // ]);
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
    public function show(datadiajukan $datadiajukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(datadiajukan $datadiajukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, datadiajukan $datadiajukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(datadiajukan $datadiajukan)
    {
        //
    }
}
