<?php

namespace App\Http\Controllers;

use App\Models\jenis_pajak;
use Illuminate\Http\Request;

class DatajenispajakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenis_pajak'] = jenis_pajak::get();
        return view('admin2.datajenispajak', $data);
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
            'nama_jenis_pajak' => 'required|string|max:255',
        ]);

        // Simpan ke database
        $data = jenis_pajak::create([
            'nama_jenis_pajak' => $validated['nama_jenis_pajak'],
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Mitra berhasil ditambahkan!');
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
         // Validasi input
         $validated = $request->validate([
            'nama_jenis_pajak' => 'required|string|max:255',
        ]);

        // Cari data mitra berdasarkan ID
        $jenis_pajak = jenis_pajak::findOrFail($id);

        // Update data mitra
        $jenis_pajak->update([
            'nama_jenis_pajak' => $validated['nama_jenis_pajak'],
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Mitra berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $jenis_pajak = jenis_pajak::findOrFail($id);
        $jenis_pajak->delete();
        return redirect('/datajenispajak');
    }
}
