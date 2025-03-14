<?php

namespace App\Http\Controllers;

use App\Models\mitra;
use App\Models\datamitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DatamitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['mitra'] = mitra::get();
        return view('admin2.datamitra', $data);
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
            'nama_mitra' => 'required|string|max:255',
            'flag_agg' => 'required|in:0,1',
            'flag_bank' => 'required|in:0,1',
        ]);

        // cek data agar tidak duplikat
        $exists = Mitra::where('nama_mitra', $validated['nama_mitra'])->exists();

        if ($exists) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data sudah ada, tidak dapat menambahkan data yang sama.');
            return redirect('/datamitra');
        }

        // Simpan ke database
        Mitra::create([
            'nama_mitra' => $validated['nama_mitra'],
            'flag_agg' => $request->flag_agg,
            'flag_bank' => $request->flag_bank,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil di Simpan');
        return redirect('/datamitra');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'flag_agg' => 'required|in:0,1',
            'flag_bank' => 'required|in:0,1',
        ]);


        // Cari data mitra berdasarkan ID
        $mitra = Mitra::findOrFail($id);

        // Cek data di tabel utama
        $isUsed = DB::table('payment_mba')
            ->where('mitra_agg', $mitra->id)
            ->orWhere('mitra_id', $mitra->id)
            ->exists();

        if ($isUsed) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data tidak dapat diperbarui karena masih digunakan di tabel lain.');
            return redirect('/datamitra');
        }

        // Cek data agar tidak duplikat
        $existingData = Mitra::where('nama_mitra', $request['nama_mitra'])
            ->where('id', '!=', $id) // Mengecualikan ID yang sedang diedit
            ->first();//mengambil data yang sudah ada

        if ($existingData !== null) {
            Session::flash('status', 'danger');
            Session::flash('message',  "Data dengan nama '{$existingData->nama_mitra}' sudah ada, tidak dapat memperbarui data.");
            return redirect('/datamitra');
        }


        // Jika tidak digunakan, update data mitra
        $mitra->update([
            'nama_mitra' => $validated['nama_mitra'],
            'flag_agg'   => $request->flag_agg,
            'flag_bank'  => $request->flag_bank,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Perbarui');
        return redirect('/datamitra');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $mitra = Mitra::findOrFail($id);

        // Cek apakah data mitra digunakan di tabel utama (contoh: tabel `payment_mba`)
        $isUsed = DB::table('payment_mba')
            ->where('mitra_agg', $mitra->id)
            ->orWhere('mitra_id', $mitra->id) // Tambahkan pengecekan mitra_id
            ->exists();

        if ($isUsed) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data tidak dapat dihapus karena masih digunakan di tabel lain.');

            return redirect('/datamitra');
        }

        // Jika tidak digunakan, hapus data
        $mitra->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil dihapus.');

        return redirect('/datamitra');
    }
}
