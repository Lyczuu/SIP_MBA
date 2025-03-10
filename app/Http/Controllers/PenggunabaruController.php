<?php

namespace App\Http\Controllers;


use App\Models\role;
use App\Models\User;
use App\Models\wilayah;
use App\Models\Penggunabaru;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
            'username'     => 'required|string|max:255|unique:users,username',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'full_name'    => 'required|string|max:255',
            'alamat'       => 'nullable|string',
            'phone_number' => 'nullable|string|max:15',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|min:6|max:8|confirmed',
            'role_id'      => 'required|exists:roles,id', // Pastikan role_id ada di tabel roles
        ]);

        // Cek apakah ada file gambar yang di-upload
        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        // Buat user baru
        User::create([
            'username'     => $request->username,
            'profile_image' => $imagePath,
            'full_name'    => $request->full_name,
            'alamat'       => $request->alamat,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role_id'      => $request->role_id, // Tambahkan role_id
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'User berhasil ditambahkan');
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
        // Ambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'username'     => 'required|string|max:255|unique:users,username,' . $id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'full_name'    => 'required|string|max:255',
            'alamat'       => 'nullable|string',
            'phone_number' => 'nullable|string|max:15',
            'email'        => 'required|email|unique:users,email,' . $id,
            'role_id'      => 'required|exists:roles,id',
            'password'     => 'nullable|min:6|max:8|confirmed',
        ]);

        // Cek apakah ada file gambar yang di-upload
        if ($request->hasFile('profile_image')) {
            // Simpan gambar ke dalam storage/app/public/profile_images
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');

            // Hapus gambar lama jika ada
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Simpan path gambar baru ke database
            $user->profile_image = $imagePath;
        }

        // Update data pengguna
        $user->update([
            'username'     => $request->username,
            'profile_image' => isset($imagePath) ? $imagePath : $user->profile_image,
            'full_name'    => $request->full_name,
            'alamat'       => $request->alamat,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'role_id'      => $request->role_id,
            'password'     => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);
        
        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil diperbarui');
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
