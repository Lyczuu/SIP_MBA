<?php

namespace App\Http\Controllers;

use App\Models\paymentmba;
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
        $data['pengajuanintegrasi'] = PengajuanIntegrasi::withTrashed()->orderBy(DB::raw('GREATEST(created_at, updated_at)'), 'desc')->get();
        return view('admin2.datapengajuanintegrasi', $data);
    }



    public function restore($id)
    {
        $pengajuanintegrasi = PengajuanIntegrasi::withTrashed()->where('id', $id)->first();

        if ($pengajuanintegrasi) {
            $pengajuanintegrasi->restore(); // Mengembalikan data
            Session::flash('status', 'success');
            Session::flash('message', 'Data Berhasil Dikembalikan.');
        } else {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data tidak ditemukan.');
        }

        return redirect()->back();
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



        // Cek apakah data dengan nama yang sama sudah ada
        $existingData = PengajuanIntegrasi::where('nama_pengajuan_integrasi', $request['nama_pengajuan_integrasi'])
            ->first();

        if ($existingData) {
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$existingData->nama_pengajuan_integrasi}' sudah ada, tidak dapat menambahkan data yang sama.");

            return redirect()->back()->withInput();
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
        $pengajuanintegrasi = pengajuanintegrasi::findOrFail($id);


        // Cek data agar tidak duplikat
        $exists = PengajuanIntegrasi::where(function ($query) use ($validated) {
            $query->where('nama_pengajuan_integrasi', $validated['nama_pengajuan_integrasi']);
        })
            ->where('id', '!=', $id) // Mengecualikan data yang sedang diedit
            ->first();

        if ($exists !== null) {
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$exists->nama_pengajuan_integrasi}' sudah ada, tidak dapat memperbarui data.");

            return redirect()->back()->withInput();
        }

        // Update data mitra
        $pengajuanintegrasi->update([
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
        $pengajuanintegrasi = pengajuanintegrasi::findOrFail($id);

        $pengajuanintegrasi->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Dihapus');
        return redirect('/datapengajuanintegrasi');
    }
}
