<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jenistransaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DatajenistransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenis_transaksi'] = jenistransaksi::get();
        return view('admin2.datajenistransaksi', $data);
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
            'nama_jenis_transaksi' => 'required|string|max:255',
        ]);

        // Cek data agar tidak duplikat
        $exists = jenistransaksi::where('nama_jenis_transaksi', $request['nama_jenis_transaksi'])
            ->exists();

        if ($exists) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data sudah ada, tidak dapat menambahkan data yang sama.');
            return redirect('/datajenistransaksi');
        }

        // Simpan ke database
        jenistransaksi::create([
            'nama_jenis_transaksi' => $validated['nama_jenis_transaksi'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Simpan');
        return redirect('/datajenistransaksi');
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
            'nama_jenis_transaksi' => 'required|string|max:255',
        ]);

        // Cari data mitra berdasarkan ID
        $jenis_transaksi = jenistransaksi::findOrFail($id);

        // Cek data di tabel utama
        $isUsed = DB::table('payment_mba')->where('transaksi_id', $jenis_transaksi->id)->exists();

        if ($isUsed) {
            Session::flash('status', 'danger'); //  Perbaikan dari "dangger" ke "danger"
            Session::flash('message', 'Data tidak dapat diperbarui karena masih digunakan di tabel lain.');

            return redirect('/datajenistransaksi');
        }


        // Cek apakah data provinsi dengan nama atau kode yang sama sudah ada
        $exists = jenistransaksi::where(function ($query) use ($validated) {
            $query->where('nama_jenis_transaksi', $validated['nama_jenis_transaksi']);
        })
            ->where('id', '!=', $id) // Mengecualikan data yang sedang diedit
            ->first();

        if ($exists !== null) {
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$exists->nama_jenis_transaksi}' sudah ada, tidak dapat memperbarui data.");
            return redirect('/datajenistransaksi');
        }


        // Update data mitra
        $jenis_transaksi->update([
            'nama_jenis_transaksi' => $validated['nama_jenis_transaksi'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Perbarui');
        return redirect('/datajenistransaksi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenis_transaksi = jenistransaksi::findOrFail($id);

        // Cek apakah data digunakan di tabel utama (contoh: tabel `payment_mba`)
        $isUsed = DB::table('payment_mba')
            ->where('transaksi_id', $jenis_transaksi->id)
            ->exists();

        if ($isUsed) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data tidak dapat dihapus karena masih digunakan di tabel lain.');
            return redirect('/datajenistransaksi');
        }

        $jenis_transaksi->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil di hapus');
        return redirect('/datajenistransaksi');
    }
}
