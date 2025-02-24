<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\wilayah;
use App\Models\provinsi;
use App\Models\paymentmba;
use App\Models\Userwilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserwilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $users = User::with('wilayahs')->get();
        $wilayah = wilayah::all();
        $user = user::all();
        $provinsi = provinsi::all();
        return view('admin2.datauserwilayah', compact('wilayah', 'user','provinsi'));
    }

    public function assignWilayah(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'wilayah_id' => 'required|array',
            'wilayah_id.*' => 'exists:wilayah,id',
        ]);

        // Cari user berdasarkan ID yang dipilih
        $user = User::find($request->user_id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        // Assign wilayah ke user
        $user->wilayah()->sync($request->wilayah_id);

        return back()->with('success', 'Wilayah berhasil diperbarui untuk user ' . $user->name);
    }

    public function getWilayahByProv(Request $request)
    {
        $wilayah = Wilayah::where('kode_prov', $request->kode_prov)->get();

        $html = '';
        foreach ($wilayah as $w) {
            $html .= '
            <tr>
                <td>' . $w->kode_area . '</td>
                <td>' . $w->nama_wilayah . '</td>
                <td>
                    <input type="checkbox" name="wilayah_id[]" value="' . $w->id . '">
                </td>
            </tr>';
        }

        return response()->json($html);
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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'wilayah_id' => 'required|exists:wilayah,id',
        ]);

        $user = User::find($request->user_id);
        $user->wilayah()->attach($request->wilayah_id);

        return redirect()->back()->with('success', 'Wilayah berhasil ditambahkan ke user!');
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
