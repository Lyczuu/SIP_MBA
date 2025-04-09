<?php

namespace App\Http\Controllers;

use App\Models\paymentmba;
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
        $data['jenistransaksi'] = jenistransaksi::withTrashed()->orderBy(DB::raw('GREATEST(created_at, updated_at)'), 'desc')->get();
        return view('admin2.datajenistransaksi', $data);
    }



    public function restore($id)
    {
        $jenistransaksi = jenistransaksi::withTrashed()->where('id', $id)->first();

        if ($jenistransaksi) {
            $jenistransaksi->restore(); // Mengembalikan data
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
            'nama_jenis_transaksi' => 'required|string|max:255',
        ]);

        // Cek data agar tidak duplikat
        $existingData = jenistransaksi::where('nama_jenis_transaksi', $request['nama_jenis_transaksi'])
            ->first();

        if ($existingData) {
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$existingData->nama_jenis_transaksi}' sudah ada, tidak dapat menambahkan data yang sama.");

            return redirect()->back()->withInput();
        }

        // Simpan ke database
        jenistransaksi::create([
            'nama_jenis_transaksi' => $validated['nama_jenis_transaksi'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Disimpan');
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


        $jenistransaksi = jenistransaksi::findOrFail($id);


        // Cek apakah data jenistransaksi dengan nama atau kode yang sama sudah ada
        $exists = jenistransaksi::where(function ($query) use ($validated) {
            $query->where('nama_jenis_transaksi', $validated['nama_jenis_transaksi']);
        })
            ->where('id', '!=', $id) // Mengecualikan data yang sedang diedit
            ->first();

        if ($exists !== null) {
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$exists->nama_jenis_transaksi}' sudah ada, tidak dapat memperbarui data.");

            return redirect()->back()->withInput();
        }


        // Update data jenis$jenistransaksi
        $jenistransaksi->update([
            'nama_jenis_transaksi' => $validated['nama_jenis_transaksi'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Diperbarui');
        return redirect('/datajenistransaksi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenistransaksi = jenistransaksi::findOrFail($id);


        $jenistransaksi->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Dihapus');
        return redirect('/datajenistransaksi');
    }
}
