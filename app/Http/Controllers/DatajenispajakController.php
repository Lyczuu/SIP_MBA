<?php

namespace App\Http\Controllers;

use App\Models\jenispajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DatajenispajakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenis_pajak'] = jenispajak::get();
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
        $data = jenispajak::create([
            'nama_jenis_pajak' => $validated['nama_jenis_pajak'],
        ]);

        Session::flash('status','success');
        Session::flash('message','Data Berhasil Di Simpan');
        return redirect('/datajenispajak');

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
        $jenis_pajak = jenispajak::findOrFail($id);

        // Update data mitra
        $jenis_pajak->update([
            'nama_jenis_pajak' => $validated['nama_jenis_pajak'],
        ]);

        Session::flash('status','success');
        Session::flash('message','Data Berhasil Di Ubah');
        return redirect('/datajenispajak');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $jenis_pajak = jenispajak::findOrFail($id);
        $jenis_pajak->delete();
        Session::flash('status','success');
        Session::flash('message','Data Berhasil Di hapus');
        return redirect('/datajenispajak');

    }
}
