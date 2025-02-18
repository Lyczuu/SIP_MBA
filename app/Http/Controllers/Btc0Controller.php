<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Btc0Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bahan0.homeadmin0');
    }

    public function table()
    {
        return view('bahan0.tablelist0');
    }

    public function input()
    {
        return view('bahan0.input0');
    }

    public function user()
    {
        return view('bahan0.userprofile0');
    }

    public function tbtlk()
    {
        return view('bahan0.tableditolak0');
    }

    public function tbstj()
    {
        return view('bahan0.tabledisetujui0');
    }

    public function detail()
    {
        return view('bahan0.detailpayment0');
    }

    public function pengguna()
    {
        return view('bahan0.userlist0');
    }

    public function mitra()
    {
        return view('bahan0.mitra0');
    }

    public function wilayah()
    {
        return view('bahan0.wilayah0');
    }

    public function penggunaadd()
    {
        return view('bahan0.usertambah0');
    }

    public function detailuser()
    {
        return view('bahan0.userdetail0');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
