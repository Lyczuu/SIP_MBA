<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class ProfilController extends Controller
{
    //
    public function index()
    {

        $user = User::all();

        return view('admin.profil', compact('user'));
    }

    public function update(Request $request)
    {
        // Ambil user yang sedang login
        $user = User::find(Auth::id());

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Validasi input
        $request->validate([
            'username'     => 'required|string|max:255|unique:users,username,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'full_name'    => 'required|string|max:255',
            'alamat'       => 'nullable|string',
            'phone_number' => 'nullable|string|max:15',
            'email'        => 'required|email|unique:users,email,' . $user->id,
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

        // Update data user
        $user->update([
            'username'     => $request->username,
            'profile_image' => isset($imagePath) ? $imagePath : $user->profile_image,
            'full_name'    => $request->full_name,
            'alamat'       => $request->alamat,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'password'     => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);


        Session::flash('status','success');
        Session::flash('message','Data Berhasil Di Perbarui');
        return redirect('/admin/profil');
    }

}
