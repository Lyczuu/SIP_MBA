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
        return view('admin2.datawilayah', compact('wilayah','provinsi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

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

        // Simpan data ke dalam tabel wilayah
        Wilayah::create([
            'nama_wilayah' => $request->nama_wilayah,
            'kode_prov' => $request->kode_prov,
            'kode_area' => $request->kode_area,
        ]);

        Session::flash('status','success');
        Session::flash('message','Data Berhasil Di Simpan');
        return redirect('/datawilayah');
    }
    /**
     * Display the specified resource.
     */
    public function show(datawilayah $datawilayah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(datawilayah $datawilayah)
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
            'nama_wilayah' => 'required|string|max:255',
            'kode_prov' => 'required|string|max:255',
            'kode_area' => 'required|string|max:255',
        ]);

        // Cari data mitra berdasarkan ID
        $wilayah = wilayah::findOrFail($id);

        // Update data mitra
        $wilayah->update([
            'nama_wilayah' => $validated['nama_wilayah'],
            'kode_prov' => $validated['kode_prov'],
            'kode_area' => $validated['kode_area'],
        ]);

        Session::flash('status','success');
        Session::flash('message','Data Berhasil Di Ubah');
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
            Session::flash('status', 'danger'); // ✅ Perbaikan dari "dangger" ke "danger"
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
