<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanIntegrasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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


        // Cek apakah data provinsi dengan nama atau kode yang sama sudah ada
        $exists = PengajuanIntegrasi::where('nama_pengajuan_integrasi', $request['nama_pengajuan_integrasi'])
            ->exists();

        if ($exists) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data sudah ada, tidak dapat menambahkan data yang sama.');
            return redirect('/datapengajuanintegrasi');
        }

        // Simpan ke database
        pengajuanintegrasi::create([
            'nama_pengajuan_integrasi' => $validated['nama_pengajuan_integrasi'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Simpan');
        return redirect('/datapengajuanintegrasi');
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


        // Cek data di tabel utama
        $isUsed = DB::table('payment_mba')->where('pengajuan_integrasi_id', $pengajuan_integrasi->id)->exists();

        if ($isUsed) {
            Session::flash('status', 'danger'); //  Perbaikan dari "dangger" ke "danger"
            Session::flash('message', 'Data tidak dapat diperbarui karena masih digunakan di tabel lain.');

            return redirect('/datapengajuanintegrasi');
        }


        // Cek data agar tidak duplikat
        $exists = PengajuanIntegrasi::where(function ($query) use ($validated) {
            $query->where('nama_pengajuan_integrasi', $validated['nama_pengajuan_integrasi']);
        })
            ->where('id', '!=', $id) // Mengecualikan data yang sedang diedit
            ->first();

        if ($exists !== null) {
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$exists->nama_pengajuan_integrasi}' sudah ada, tidak dapat memperbarui data.");
            return redirect('/datapengajuanintegrasi');
        }

        // Update data mitra
        $pengajuan_integrasi->update([
            'nama_pengajuan_integrasi' => $validated['nama_pengajuan_integrasi'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Perbarui');
        return redirect('/datapengajuanintegrasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengajuan_integrasi = pengajuanintegrasi::findOrFail($id);

        // Cek data di tabel utama
        $isUsed = DB::table('payment_mba')->where('pengajuan_integrasi_id', $pengajuan_integrasi->id)->exists();

        if ($isUsed) {
            Session::flash('status', 'danger'); //  Perbaikan dari "dangger" ke "danger"
            Session::flash('message', 'Data tidak dapat dihapus karena masih digunakan di tabel lain.');

            return redirect('/datapengajuanintegrasi');
        }

        $pengajuan_integrasi->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil di hapus');
        return redirect('/datapengajuanintegrasi');
    }
}
