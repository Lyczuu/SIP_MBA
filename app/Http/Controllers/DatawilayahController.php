<?php

namespace App\Http\Controllers;

use App\Models\wilayah;
use App\Models\provinsi;
use App\Models\datawilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DatawilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wilayah = Wilayah::with('provinsi')->get();
        $provinsi = provinsi::all();
        return view('admin2.datawilayah', compact('wilayah', 'provinsi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama_wilayah' => 'required|string|max:255',
            'kode_prov' => 'required|exists:provinsi,kode_prov', // Pastikan kode provinsi valid
            'kode_area' => 'required|string|max:255',
        ]);

        // Cek apakah data provinsi dengan nama atau kode yang sama sudah ada
        $exists = Wilayah::where('nama_wilayah', $request['nama_wilayah'])
            ->orWhere('kode_area', $request['kode_area'])
            ->exists();

        if ($exists) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data sudah ada, tidak dapat menambahkan data yang sama.');
            return redirect('/datawilayah');
        }

        // Simpan data ke dalam tabel wilayah
        Wilayah::create([
            'nama_wilayah' => $request->nama_wilayah,
            'kode_prov' => $request->kode_prov,
            'kode_area' => $request->kode_area,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Simpan');
        return redirect('/datawilayah');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_wilayah' => 'required|string|max:255',
            'kode_prov' => 'required|string|max:255',
            'kode_area' => 'required|string|max:255',
        ]);

        // Cari data mitra berdasarkan ID
        $wilayah = wilayah::findOrFail($id);


        // Cek apakah data wilayah digunakan di tabel utama (contoh: tabel `payment_mba`)
        $isUsed = DB::table('payment_mba')
            ->where('wilayah_id', $wilayah->id)
            ->exists();

        if ($isUsed) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data tidak dapat diperbarui karena masih digunakan di tabel lain.');
            return redirect('/datawilayah');
        }

        // Cek apakah data provinsi dengan nama atau kode yang sama sudah ada
        $existingData = Wilayah::where(function ($query) use ($request) {
            $query->whereRaw('LOWER(nama_wilayah) = LOWER(?)', [$request['nama_wilayah']])
                ->orWhereRaw('LOWER(kode_area) = LOWER(?)', [$request['kode_area']]);
        })
            ->where('id', '!=', $id) // Mengecualikan data yang sedang diedit
            ->first();

        if ($existingData !== null) {
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$existingData->nama_wilayah}' atau kode area '{$existingData->kode_area}' sudah ada, tidak dapat memperbarui data.");
            return redirect('/datawilayah');
        }



        // Update data mitra
        $wilayah->update([
            'nama_wilayah' => $validated['nama_wilayah'],
            'kode_prov' => $validated['kode_prov'],
            'kode_area' => $validated['kode_area'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Perbarui');
        return redirect('/datawilayah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wilayah = wilayah::findOrFail($id);

        // Cek apakah data provinsi digunakan di tabel `wilayah` atau `payment_mba`
        $isUsed = DB::table('payment_mba')->where('wilayah_id', $wilayah->id)->exists();

        if ($isUsed) {
            Session::flash('status', 'danger'); //  Perbaikan dari "dangger" ke "danger"
            Session::flash('message', 'Data tidak dapat dihapus karena masih digunakan di tabel lain.');

            return redirect('/datawilayah');
        }

        // Jika tidak digunakan, hapus data
        $wilayah->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil dihapus.');

        return redirect('/datawilayah');
    }
}
