<?php

namespace App\Http\Controllers;

use App\Models\provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        Session::flash('status','success');
        Session::flash('message','Data berhasil di Simpan');
        return redirect('/dataprovinsi');
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
    public function update(Request $request, $id)
    {
         // Validasi input
         $validated = $request->validate([
            'nama_provinsi' => 'required|string|max:255',
            'kode_prov' => 'required|string|max:255',

        ]);

        // Cari data mitra berdasarkan ID
        $provinsi = provinsi::findOrFail($id);

        // Update data mitra
        $provinsi->update([
            'nama_provinsi' => $validated['nama_provinsi'],
            'kode_prov' => $validated['kode_prov'],
        ]);

        Session::flash('status','success');
        Session::flash('message','Data Berhasil Di Ubah');
        return redirect('/dataprovinsi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $provinsi = provinsi::findOrFail($id);
        $provinsi->delete();
        Session::flash('status','success');
        Session::flash('message','Data Berhasil Di Hapus');
        return redirect('/dataprovinsi');
    }
}
