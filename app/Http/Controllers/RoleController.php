<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
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
        $role = Role::withTrashed()->where('nama_role', '!=', 'Admin')->orderBy(DB::raw('GREATEST(created_at, updated_at)'), 'desc')->get();

        return view('admin2.datarole', compact('role'));
    }


    public function restore($id)
    {
        $role = role::withTrashed()->where('id', $id)->first();

        if ($role) {
            $role->restore(); // Mengembalikan data
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
        $validated = $request->validate([
            'nama_role' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $existingData = role::where('nama_role', $validated['nama_role'])->first();

        if ($existingData) {
            Session::flash('status', 'danger');
            Session::flash('message',  "Data dengan nama '{$existingData->nama_role}' sudah ada, tidak dapat menambahkan data yang sama.");

            return redirect()->back()->withInput();
        }


        role::create([
            'nama_role' => $validated['nama_role'],
            'keterangan' => $validated['keterangan'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Disimpan');
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


        //check data yang duplikat
        $existingData = role::where('nama_role', $validated['nama_role'])
            ->where('id', '!=', $id)
            ->first();

        if ($existingData != null) {
            Session::flash('status', 'danger');
            Session::flash('message', "Data dengan nama '{$existingData->nama_role}' sudah ada, tidak dapat memperbarui data.");

            return redirect()->back()->withInput();
        }


        $role->update([
            'nama_role' => $validated['nama_role'],
            'keterangan' => $validated['keterangan'],
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Diperbarui');
        return redirect('/role');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = role::findOrfail($id);


        if ($role->nama_role === 'Admin') {
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => 'Role "Admin" tidak dapat dihapus!'
            ]);
        }

        $role->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Data Berhasil Dihapus');
        return redirect('/role');
    }
}
