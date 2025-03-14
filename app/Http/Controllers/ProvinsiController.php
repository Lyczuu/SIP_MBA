<?php

namespace App\Http\Controllers;

use App\Models\provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // Cek apakah data provinsi dengan nama atau kode yang sama sudah ada
        $exists = Provinsi::where('nama_provinsi', $validated['nama_provinsi'])
            ->orWhere('kode_prov', $validated['kode_prov'])
            ->exists();

        if ($exists) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data sudah ada, tidak dapat menambahkan data yang sama.');
            return redirect('/dataprovinsi');
        }


        // Simpan data ke dalam database
        provinsi::create([
            'nama_provinsi' => $validated['nama_provinsi'],
            'kode_prov' => $validated['kode_prov'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil di Simpan');
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


        // Cari data provinsi ID
        $provinsi = provinsi::findOrFail($id);


        // Cek apakah data provinsi digunakan di tabel `wilayah` atau `payment_mba`
        $isUsed = DB::table('wilayah')->where('kode_prov', $provinsi->id)->exists() ||
            DB::table('payment_mba')->where('wilayah_id', $provinsi->id)->exists();

        if ($isUsed) {
            Session::flash('status', 'danger'); //Perbaikan dari "dangger" ke "danger"
            Session::flash('message', 'Data tidak dapat diperbarui karena masih digunakan di tabel lain.');

            return redirect('/dataprovinsi');
        }

        // Cek apakah data provinsi dengan nama atau kode yang sama sudah ada
        $existingData = Provinsi::where(function ($query) use ($validated) {
            $query->where('nama_provinsi', $validated['nama_provinsi'])
                ->orWhere('kode_prov', $validated['kode_prov']);
        })
            ->where('id', '!=', $id) // Mengecualikan data yang sedang diedit
            ->first();

        if ($existingData  !== null) {
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$existingData->nama_provinsi}' atau kode_prov '{$existingData->kode_prov}' sudah ada, tidak dapat memperbarui data.");
            return redirect('/dataprovinsi');
        }

        // Update data provinsi
        $provinsi->update([
            'nama_provinsi' => $validated['nama_provinsi'],
            'kode_prov' => $validated['kode_prov'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Perbarui');
        return redirect('/dataprovinsi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $provinsi = provinsi::findOrFail($id);

        // Cek data provinsi digunakan di tabel `wilayah` atau `payment_mba`
        $isUsed = DB::table('wilayah')->where('kode_prov', $provinsi->id)->exists() ||
            DB::table('payment_mba')->where('wilayah_id', $provinsi->id)->exists();

        if ($isUsed) {
            Session::flash('status', 'danger'); //  Perbaikan dari "dangger" ke "danger"
            Session::flash('message', 'Data tidak dapat dihapus karena masih digunakan di tabel lain.');

            return redirect('/dataprovinsi');
        }

        // Jika tidak digunakan, hapus data
        $provinsi->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil dihapus.');

        return redirect('/dataprovinsi');
    }
}
