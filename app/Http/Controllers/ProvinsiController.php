<?php

namespace App\Http\Controllers;

use App\Models\wilayah;
use App\Models\provinsi;
use App\Models\paymentmba;
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
        $provinsi = Provinsi::withTrashed()->orderBy(DB::raw('GREATEST(created_at, updated_at)'), 'desc')->get();
        return view('admin2.dataprovinsi', compact('provinsi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function restore($id)
    {
        $provinsi = provinsi::withTrashed()->where('id', $id)->first();

        if ($provinsi) {
            $provinsi->restore(); // Mengembalikan data
            Session::flash('status', 'success');
            Session::flash('message', 'Data Berhasil Dikembalikan.');
        } else {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data tidak ditemukan.');
        }

        return redirect()->back();
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


        // Cek apakah data dengan nama atau kode provinsi yang sama sudah ada
        $existingData = Provinsi::where('nama_provinsi', $validated['nama_provinsi'])
            ->orWhere('kode_prov', $validated['kode_prov'])
            ->first();

        if ($existingData) {
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$existingData->nama_provinsi}' atau kode prov '{$existingData->kode_prov}' sudah ada, tidak dapat menambahkan data yang sama.");

            return redirect()->back()->withInput();
        }


        // Simpan data ke dalam database
        provinsi::create([
            'nama_provinsi' => $validated['nama_provinsi'],
            'kode_prov' => $validated['kode_prov'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Disimpan');
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


        // Cek apakah data provinsi masih digunakan di `wilayah` atau `payment_mba`


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

            return redirect()->back()->withInput();
        }

        // Update data provinsi
        $provinsi->update([
            'nama_provinsi' => $validated['nama_provinsi'],
            'kode_prov' => $validated['kode_prov'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Diperbarui');
        return redirect('/dataprovinsi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $provinsi = Provinsi::findOrFail($id);

        // Jika tidak digunakan, hapus data
        $provinsi->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Dihapus.');
        return redirect('/dataprovinsi');
    }
}
