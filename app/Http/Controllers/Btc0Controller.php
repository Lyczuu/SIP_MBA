<?php

namespace App\Http\Controllers;

use App\Models\ditolak;
use App\Models\wilayah;
use App\Models\paymentmba;
use App\Models\jenis_pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Btc0Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentmba = PaymentMba::all()->map(function ($item) {
            $jenisPajakIds = explode(',', $item->jenis_pajak_id);
            $item->jenis_pajak_nama = jenis_pajak::whereIn('id', $jenisPajakIds)->pluck('nama_jenis_pajak')->implode(', ');
            return $item;
        });
        $ditolak = ditolak::with('user')->get();
        $user = Auth::user();
        $paymentmbafee = PaymentMBA::where('user_id', $user->id)->get();
        return view('admin2.homeadmin0', compact('paymentmba', 'paymentmbafee', 'user', 'ditolak'));

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
