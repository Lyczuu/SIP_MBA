<?php

namespace App\Http\Controllers;

use App\Models\PengajuanIntegrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatapengajuanintegrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pengajuanintegrasi'] = PengajuanIntegrasi::get();
        return view('admin2.datapengajuanintegrasi', $data);
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
            'nama_pengajuan_integrasi' => 'required|string|max:255',
        ]);

        // Simpan ke database
        $data = pengajuanintegrasi::create([
            'nama_pengajuan_integrasi' => $validated['nama_pengajuan_integrasi'],
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
            'nama_pengajuan_integrasi' => 'required|string|max:255',
        ]);

        // Cari data mitra berdasarkan ID
        $pengajuan_integrasi = pengajuanintegrasi::findOrFail($id);

        // Update data mitra
        $pengajuan_integrasi->update([
            'nama_pengajuan_integrasi' => $validated['nama_pengajuan_integrasi'],
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Mitra berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $pengajuan_integrasi =pengajuanintegrasi::findOrFail($id);
        $pengajuan_integrasi->delete();
        return redirect('/datapengajuanintegrasi')->with('success', 'Data berhasil dihapus!');
    }
}
