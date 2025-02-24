<?php

namespace App\Http\Controllers;

use App\Models\provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinsi = provinsi::all();
        return view('admin2.dataprovinsi', compact('provinsi'));
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
        // Validasi input
        $validated = $request->validate([
            'nama_provinsi' => 'required|string|max:255',
            'kode_prov' => 'required|string|max:255',

        ]);

        // Simpan data ke dalam database
        provinsi::create([
            'nama_provinsi' => $validated['nama_provinsi'],
            'kode_prov' => $validated['kode_prov'],
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Wilayah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(provinsi $provinsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(provinsi $provinsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, provinsi $provinsi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(provinsi $provinsi)
    {
        //
    }
}
