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

        // Simpan ke database
        $data = Mitra::create([
            'nama_mitra' => $validated['nama_mitra'],
            'flag_agg' => $request->flag_agg,
            'flag_bank' => $request->flag_bank,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil di Simpan');
        return redirect('/datamitra');
    }

    /**
     * Display the specified resource.
     */
    public function show(datamitra $datamitra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(datamitra $datamitra)
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
            'nama_mitra' => 'required|string|max:255',
            'flag_agg' => 'required|in:0,1',
            'flag_bank' => 'required|in:0,1',
        ]);

        // Cari data mitra berdasarkan ID
        $mitra = Mitra::findOrFail($id);

        // Update data mitra
        $mitra->update([
            'nama_mitra' => $validated['nama_mitra'],
            'flag_agg' => $request->flag_agg,
            'flag_bank' => $request->flag_bank,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Ubah');
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

            // **Tambahkan return agar penghapusan tidak dilanjutkan**
            return redirect('/datamitra');
        }

        // Jika tidak digunakan, hapus data
        $mitra->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil dihapus.');

        return redirect('/datamitra');
    }
}
