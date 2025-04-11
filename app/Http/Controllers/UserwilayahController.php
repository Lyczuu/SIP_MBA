<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\wilayah;
use App\Models\provinsi;
use App\Models\Userwilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserwilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $selectedWilayah = DB::table('user_wilayah')->pluck('wilayah_id')->toArray();
        $wilayah = Wilayah::all(); // Ambil semua data wilayah
        $user = User::whereHas('role', function ($query) {
            $query->where('nama_role', '!=', 'admin');
        })->get();

        $provinsi = provinsi::all();
        return view('admin2.datauserwilayah', compact('wilayah', 'user', 'provinsi', 'selectedWilayah'));
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
            'user_id' => 'required|exists:users,id',
            'wilayah_id' => 'nullable|array', // Bisa kosong jika semua wilayah dihapus
            'wilayah_id.*' => 'exists:wilayah,id', // Pastikan setiap wilayah valid
        ]);

        // Ambil user berdasarkan ID
        $user = User::findOrFail($request->user_id);

        // Ambil semua wilayah yang sudah diberikan ke user lain
        $wilayahTerpakai = DB::table('user_wilayah')
            ->where('user_id', '!=', $user->id) // Ambil wilayah user lain
            ->pluck('wilayah_id')
            ->toArray();

        // Wilayah yang ingin disimpan dari request (jika ada)
        $requestedWilayahIds = $request->wilayah_id ?? [];

        // Ambil wilayah yang saat ini dimiliki user
        $currentWilayahIds = $user->wilayah()->pluck('wilayah_id')->toArray();

        // Hapus wilayah yang tidak dicentang
        $removedWilayahIds = array_diff($currentWilayahIds, $requestedWilayahIds);

        // Cek apakah wilayah yang dihapus sedang digunakan di tabel utama (misalnya payment_mba)
        $isUsed = DB::table('payment_mba')
            ->whereIn('wilayah_id', $removedWilayahIds)
            ->exists();

        if ($isUsed) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Tidak dapat menghapus wilayah yang sudah diberikan ke user dan sudah digunakan di tabel utama.');
            return redirect()->back();
        }

        // Pastikan hanya wilayah yang tidak dipakai user lain yang bisa ditambahkan
        $filteredWilayahIds = array_diff($requestedWilayahIds, $wilayahTerpakai);

        // Update wilayah user
        $user->wilayah()->sync($filteredWilayahIds);

        Session::flash('status', 'success');
        Session::flash('selected_user_id', $request->user_id);
        Session::flash('message', 'Data Berhasil Disimpan.');

        return redirect('/penggunabaru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Userwilayah $userwilayah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Userwilayah $userwilayah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Userwilayah $userwilayah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Userwilayah $userwilayah)
    {
        //
    }
}
