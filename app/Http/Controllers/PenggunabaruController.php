<?php

namespace App\Http\Controllers;


use App\Models\role;
use App\Models\User;
use App\Models\wilayah;
use App\Models\Penggunabaru;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        return view('admin2.datapenggunabaru', compact('user', 'role', 'wilayah'));
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

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Simpan');
        return redirect('/penggunabaru');
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
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'role_id' => 'required',
            'password' => 'nullable|min:6|max:8|confirmed', // Password opsional
        ]);

        // Update data
        $user->username = $request->username;
        $user->full_name = $request->full_name;
        $user->alamat = $request->alamat;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        // Cek apakah user mengisi password baru
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Hash password baru
        }

        $user->save();
        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Ubah');
        return redirect('/penggunabaru');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = user::findOrFail($id);
        $user->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Di Hapus');
        return redirect('/penggunabaru');
    }
}
