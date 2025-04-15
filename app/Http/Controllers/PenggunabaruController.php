<?php

namespace App\Http\Controllers;


use App\Models\role;
use App\Models\User;
use App\Models\wilayah;
use App\Models\paymentmba;
use App\Models\Penggunabaru;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
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
        $user = User::withTrashed()->whereHas('role', function ($query) {
            $query->where('nama_role', '!=', 'Admin');
        })
        ->orderBy(DB::raw('GREATEST(created_at, updated_at)'), 'desc')
        ->get();

        $role = Role::where('nama_role', '!=', 'Admin')->get();
        $wilayah = wilayah::all();
        return view('admin2.datapenggunabaru', compact('user', 'role', 'wilayah'));
    }



    public function restore($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();

        if ($user) {
            $user->restore(); // Mengembalikan data
            Session::flash('status', 'success');
            Session::flash('message', 'Data Berhasil Dikembalikan.');
        } else {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data tidak ditemukan.');
        }

        return redirect()->back();
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


        // Cek apakah username atau email sudah ada
        $existingUser = User::where('username', $request->username)
            ->orWhere('email', $request->email)
            ->first();

        if ($existingUser) {
            Session::flash('status', 'danger');

            if ($existingUser->username == $request->username) {
                Session::flash('message', 'Username sudah digunakan, silakan gunakan yang lain.');
            } elseif ($existingUser->email == $request->email) {
                Session::flash('message', 'Email sudah digunakan, silakan gunakan yang lain.');
            }

            return redirect()->back()->withInput();
        }

        // Validasi input
        $request->validate([
            'username'      => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'full_name'     => 'required|string|max:255',
            'alamat'        => 'nullable|string',
            'phone_number'  => 'nullable|string|max:15',
            'email'         => 'required|email',
            'password'      => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'role_id'       => 'required|exists:roles,id',
        ], [
            'password.min' => 'Password harus minimal 8 karakter.',

            'password.confirmed' => 'Konfirmasi password tidak cocok.',
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
        Session::flash('message', 'Pengguna Berhasil Ditambahkan');
        return redirect('/penggunabaru');
    }


    /**
     * Display the specified resource.
     */
    public function show($penggunabaru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($penggunabaru)
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
            'password'     => 'nullable|min:8|confirmed',
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
        Session::flash('message', 'Data Berhasil Diperbarui');
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
        Session::flash('message', 'Data Berhasil Dihapus');
        return redirect('/penggunabaru');
    }
}
