<?php

namespace App\Http\Controllers;

use App\Models\mitra;
use App\Models\ditolak;
use App\Models\wilayah;
use App\Models\paymentmba;
use App\Models\dataditolak;
use App\Models\jenis_pajak;
use Illuminate\Http\Request;
use App\Models\paymentmbafee;
use App\Models\jenis_transaksi;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class DataditolakController extends Controller
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
        $ditolak = Ditolak::with('user')->get();
        $user = Auth::user();
        $paymentmbafee = PaymentMBA::where('user_id', $user->id)->get();
        return view('admin2.dataditolak', compact('paymentmba', 'paymentmbafee', 'user', 'ditolak'));


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
