<?php

namespace App\Http\Controllers;

use App\Models\jenispajak;
use App\Models\paymentmba;
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
        $data['jenis_pajak'] = jenispajak::orderBy(DB::raw('GREATEST(created_at, updated_at)'), 'desc')->get();
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
        $existingData = jenispajak::where('nama_jenis_pajak', $request['nama_jenis_pajak'])
            ->first();

        if ($existingData) {
            Session::flash('status', 'danger');
            Session::flash('message',  "Data dengan nama '{$existingData->nama_jenis_pajak}' sudah ada, tidak dapat menambahkan data yang sama.");

            return redirect()->back()->withInput();
        }

        // Simpan ke database
        JenisPajak::create([
            'nama_jenis_pajak' => $request->nama_jenis_pajak,
            'status' => $request->status,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Disimpan');

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

        // Cek apakah data digunakan di tabel lain
        $isUsed = paymentmba::where('jenis_pajak_id', $jenis_pajak->id)->exists();

        if ($isUsed) {
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => 'Data tidak dapat diperbarui karena masih digunakan di tabel lain.'
            ]);
        }


        // Cek apakah nama jenis pajak berubah
        if ($request['nama_jenis_pajak'] !== $jenis_pajak->nama_jenis_pajak) {
            // Cek apakah nama sudah ada di database (tanpa filter status)
            $existingData = JenisPajak::where('nama_jenis_pajak', $request['nama_jenis_pajak'])
                ->where('id', '!=', $id)
                ->first();

            if ($existingData) {
                Session::flash('status', 'danger');
                Session::flash('message', "Data dengan nama '{$existingData->nama_jenis_pajak}' sudah ada, tidak dapat memperbarui data.");
                return redirect()->back()->withInput();
            }
        }


        // Update data mitra
        $jenis_pajak->update([
            'nama_jenis_pajak' => $validated['nama_jenis_pajak'],
            'status' => $request->status,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Diperbarui');

        return redirect('/datajenispajak');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenis_pajak = jenispajak::findOrFail($id);

        // Cek apakah data digunakan di tabel lain
        $isUsed = paymentmba::where('jenis_pajak_id', $jenis_pajak->id)->exists();

        if ($isUsed) {
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => 'Data tidak dapat dihapus karena masih digunakan di tabel lain.'
            ]);
        }


        $jenis_pajak->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Dihapus');
        return redirect('/datajenispajak');
    }
}
