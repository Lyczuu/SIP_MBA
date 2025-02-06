<?php

namespace App\Http\Controllers;

use App\Models\fees;
use App\Models\mitra;
use App\Models\wilayah;
use App\Models\diterima;
use App\Models\jenis_transaksi;
use App\Models\jenis_pajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;

class DiterimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['paymentmba'] = paymentmba::all();
        $data['wilayah'] = wilayah::get();
        $data['mitra'] = mitra::get();
        $data['jenis_pajak'] = jenis_pajak::all();
        $data['jenis_transaksi'] = jenis_transaksi::all();
        $data['fees'] = fees::all();

        return view('admin.diterima', $data);
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
    public function show(diterima $diterima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(diterima $diterima)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, diterima $diterima)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(diterima $diterima)
    {
        //
    }
}
