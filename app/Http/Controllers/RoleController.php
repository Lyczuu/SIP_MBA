<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = role::all();

        return view('admin2.datarole', compact('role'));
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
        $validated = $request->validate([
            'nama_role' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $existingData = role::where('nama_role', $validated['nama_role'])->first();

        if ($existingData) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data sudah ada, tidak dapat menambahkan data yang sama.');
            return redirect('/role');
        }


        role::create([
            'nama_role' => $validated['nama_role'],
            'keterangan' => $validated['keterangan'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil di Simpan');
        return redirect('/role');
    }

    /**
     * Display the specified resource.
     */
    public function show(role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_role' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $role = role::findOrfail($id);

        $isused = DB::table('roles')->where('nama_role', $role->id)->exists() ||
            DB::table('users')->where('role_id', $role->id)->exists();

        if ($isused) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data tidak bisa dihapus karena masih digunakan di tabel lain');
            return redirect('/role');
        }

        $existingData = role::where('nama_role', $validated['nama_role'])->first();

        if ($existingData) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data sudah ada, tidak dapat menambahkan data yang sama.');
            return redirect('/role');
        }


        $role->update([
            'nama_role' => $validated['nama_role'],
            'keterangan' => $validated['keterangan'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil di Update');
        return redirect('/role');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = role::findOrfail($id);

        $isused = DB::table('roles')->where('nama_role', $role->id)->exists() ||
            DB::table('users')->where('role_id', $role->id)->exists();

        if ($isused) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Data tidak bisa dihapus karena masih digunakan di tabel lain');
            return redirect('/role');
        }

        $role->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data berhasil di Hapus');
        return redirect('/role');
    }
}
