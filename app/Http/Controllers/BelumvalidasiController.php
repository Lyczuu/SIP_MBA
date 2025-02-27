<?php

namespace App\Http\Controllers;


use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Models\belumvalidasi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BelumvalidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allJenisPajak = jenispajak::pluck('nama_jenis_pajak', 'id'); // [id => nama]

        $paymentmba = PaymentMba::all()->map(function ($item) use ($allJenisPajak) {
            $jenisPajakIds = array_filter(array_map('trim', explode(',', $item->jenis_pajak_id ?? '')));
            $item->jenis_pajak_nama = collect($jenisPajakIds)
                ->map(fn($id) => $allJenisPajak[$id] ?? null)
                ->filter()
                ->implode(', ') ?: '-';
            return $item;
        });
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
