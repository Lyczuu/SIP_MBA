<?php

namespace App\Http\Controllers;

use App\Models\mitra;
use App\Models\datamitra;
use App\Models\paymentmba;
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
        $data['mitra'] = Mitra::withTrashed()->orderBy(DB::raw('GREATEST(created_at, updated_at)'), 'desc')->get();
        return view('admin2.datamitra', $data);
    }

    /**
     * Show the form for creating a new resource.
     */


    public function restore($id)
    {
        $mitra = Mitra::withTrashed()->where('id', $id)->first();

        if ($mitra) {
            $mitra->restore(); // Mengembalikan data
            Session::flash('status', 'success');
            Session::flash('message', 'Data Berhasil Dikembalikan.');
        } else {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data tidak ditemukan.');
        }

        return redirect()->back();
    }

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
        $existingData = Mitra::where('nama_mitra', $validated['nama_mitra'])->first();

        if ($existingData) {
            Session::flash('status', 'danger');
            Session::flash('message',  "Data dengan nama '{$existingData->nama_mitra}' sudah ada, tidak dapat menambahkan data yang sama.");

            return redirect()->back()->withInput();
        }

        // Simpan ke database
        Mitra::create([
            'nama_mitra' => $validated['nama_mitra'],
            'flag_agg' => $request->flag_agg,
            'flag_bank' => $request->flag_bank,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Disimpan');
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


        // Cek data agar tidak duplikat
        $existingData = Mitra::where('nama_mitra', $request['nama_mitra'])
            ->where('id', '!=', $id) // Mengecualikan ID yang sedang diedit
            ->first();

        if ($existingData !== null) {
            Session::flash('status', 'danger');
            Session::flash('message',  "Data dengan nama '{$existingData->nama_mitra}' sudah ada, tidak dapat memperbarui data.");
            return redirect()->back()->withInput();
        }


        // Jika tidak digunakan, update data mitra
        $mitra->update([
            'nama_mitra' => $validated['nama_mitra'],
            'flag_agg'   => $request->flag_agg,
            'flag_bank'  => $request->flag_bank,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Diperbarui');
        return redirect('/datamitra');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $mitra = Mitra::findOrFail($id);

        // Jika tidak digunakan, hapus data
        $mitra->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Dihapus.');

        return redirect('/datamitra');
    }
}
