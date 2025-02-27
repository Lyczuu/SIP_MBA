<?php

namespace App\Http\Controllers;


use App\Models\ditolak;
use App\Models\jenispajak;

use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Models\datadisetujui;
use Illuminate\Support\Facades\Auth;

class DatadisetujuiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentmba = PaymentMba::all()->map(function ($item) {
            $jenisPajakIds = explode(',', $item->jenis_pajak_id);
            $item->jenis_pajak_nama = jenispajak::whereIn('id', $jenisPajakIds)->pluck('nama_jenis_pajak')->implode(', ');
            return $item;
        });
        $ditolak = ditolak::with('user')->get();
        $user = Auth::user();
        $paymentmbafee = PaymentMBA::where('user_id', $user->id)->get();
        return view('admin2.datadisetujui', compact('paymentmba', 'paymentmbafee', 'user', 'ditolak'));

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
    public function show(datadisetujui $datadisetujui)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(datadisetujui $datadisetujui)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, datadisetujui $datadisetujui)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(datadisetujui $datadisetujui)
    {
        //
    }
}
