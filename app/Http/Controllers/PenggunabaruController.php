<?php

namespace App\Http\Controllers;


use App\Models\role;
use App\Models\User;
use App\Models\wilayah;
use App\Models\Penggunabaru;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PenggunabaruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        $role = role::all();
        $wilayah = wilayah::all();
        return view('admin2.datapenggunabaru', compact('user','role','wilayah'));
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
            'username' => 'required|string|max:255|unique:users',
            'full_name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'phone_number' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:6|max:8|confirmed',
        ]);

        // Simpan data ke database
        User::create([
            'username' => $request->username,
            'full_name' => $request->full_name,
            'alamat' => $request->alamat,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penggunabaru $penggunabaru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penggunabaru $penggunabaru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penggunabaru $penggunabaru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = user::findOrFail($id);
        $user->delete();
        return redirect('/penggunabaru');

    }
}
