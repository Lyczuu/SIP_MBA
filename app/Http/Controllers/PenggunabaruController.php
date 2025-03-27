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
        $user = User::orderBy(DB::raw('GREATEST(created_at, updated_at)'), 'desc')->get();
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
                'min:6',
                'max:8',
                'confirmed'
            ],
            'role_id'       => 'required|exists:roles,id',
        ], [
            'password.min' => 'Password harus minimal 6 karakter.',
            'password.max' => 'Password tidak boleh lebih dari 8 karakter.',
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
        $user = User::findOrFail($id);

        // Field yang diperbolehkan diubah meskipun user sedang digunakan di tabel payment_mba
        $allowedFields = ['profile_image', 'password'];

        // Cek apakah perubahan hanya terjadi di profile_image atau password
        $updatedFields = [];
        foreach ($allowedFields as $field) {
            if ($request->has($field) && $request->$field !== null) {
                $updatedFields[$field] = $field === 'password' ? Hash::make($request->password) : $request->$field;
            }
        }

        // Jika perubahan terjadi di luar field yang diperbolehkan, cek apakah user_id digunakan di payment_mba
        $isOtherChanges = count(array_diff_key($request->except('_token'), array_flip($allowedFields))) > 0;

        if ($isOtherChanges) {
            $isUsed = DB::table('payment_mba')->where('user_id', $id)->exists();
            if ($isUsed) {
                Session::flash('status', 'danger');
                Session::flash('message', 'Data tidak dapat diperbarui karena masih digunakan di tabel lain, kecuali password & foto profil.');
                return redirect('/penggunabaru');
            }
        }

        // Cek apakah ada file gambar yang di-upload
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');

            // Hapus gambar lama jika ada
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $updatedFields['profile_image'] = $imagePath;
        }

        // Jika ada perubahan, lakukan update
        if (!empty($updatedFields)) {
            $user->update($updatedFields);
        }

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


        // Cek apakah data provinsi digunakan di tabel `wi
        $isUsed = paymentmba::where('user_id', $user->id)->exists();

        if ($isUsed) {
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => 'Data tidak dapat dihapus karena masih digunakan di tabel lain.'
            ]);
        }


        $user->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Dihapus');
        return redirect('/penggunabaru');
    }
}
