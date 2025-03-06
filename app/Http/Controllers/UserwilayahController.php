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
        $user = user::all();
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

        // dd($request->all());
            $request->validate([
            'user_id' => 'required|exists:users,id',
            'wilayah_id' => 'required|array', // Pastikan ada wilayah yang dipilih
            'wilayah_id.*' => 'exists:wilayah,id', // Pastikan setiap wilayah valid
        ]);

        // Ambil user berdasarkan ID
        $user = User::findOrFail($request->user_id);

        // Simpan wilayah yang dipilih untuk user ini
        $user->wilayah()->sync($request->wilayah_id);

        Session::flash('status', 'success');
        Session::flash('selected_user_id', $request->user_id);
        Session::flash('message', 'Data Berhasil Di Simpan');
        return redirect('/userwilayah');
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
