<?php

namespace App\Http\Controllers;

use App\Models\jenispajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $request->validate([
            'nama_jenis_pajak' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        // Cek data agar tidak duplikat
        $exists = jenispajak::where('nama_jenis_pajak', $request['nama_jenis_pajak'])
            ->exists();

        if ($exists) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data sudah ada, tidak dapat menambahkan data yang sama.');
            return redirect('/datajenispajak');
        }

        // Simpan ke database
        JenisPajak::create([
            'nama_jenis_pajak' => $request->nama_jenis_pajak,
            'status' => $request->status,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Simpan');
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
            'status' => 'required|boolean',
        ]);

        // Cari data mitra berdasarkan ID
        $jenis_pajak = jenispajak::findOrFail($id);

        // Cek apakah data provinsi digunakan di tabel `wilayah` atau `payment_mba`
        $isUsed = DB::table('payment_mba')->where('jenis_pajak_id', $jenis_pajak->id)->exists();

        if ($isUsed) {
            Session::flash('status', 'danger'); //  Perbaikan dari "dangger" ke "danger"
            Session::flash('message', 'Data tidak dapat diperbarui karena masih digunakan di tabel lain.');

            return redirect('/datajenispajak');
        }


        // Cek data agar tidak duplikat
        $existingData = JenisPajak::where('nama_jenis_pajak', $request['nama_jenis_pajak'])
            ->where('id', '!=', $id)
            ->where('status', 'aktif')
            ->first(); // Mengambil data yang sudah ada

        if ($existingData !== null) { // Pastikan data tidak null sebelum mengakses propertinya
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$existingData->nama_jenis_pajak}' sudah ada, tidak dapat memperbarui data.");
            return redirect('/datajenispajak');
        }



        // Update data mitra
        $jenis_pajak->update([
            'nama_jenis_pajak' => $validated['nama_jenis_pajak'],
            'status' => $request->status,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Perbarui');
        return redirect('/datajenispajak');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenis_pajak = jenispajak::findOrFail($id);

        // Cek apakah data provinsi digunakan di tabel `wilayah` atau `payment_mba`
        $isUsed = DB::table('payment_mba')->where('jenis_pajak_id', $jenis_pajak->id)->exists();

        if ($isUsed) {
            Session::flash('status', 'danger'); //  Perbaikan dari "dangger" ke "danger"
            Session::flash('message', 'Data tidak dapat dihapus karena masih digunakan di tabel lain.');

            return redirect('/datajenispajak');
        }

        $jenis_pajak->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di hapus');
        return redirect('/datajenispajak');
    }
}
