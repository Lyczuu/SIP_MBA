<?php

namespace App\Http\Controllers;

use App\Models\mitra;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['mitra'] = mitra::all();
        return view('admin.dashboard', $data);
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
    public function show(mitra $mitra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mitra $mitra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mitra $mitra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mitra $mitra)
    {
        //
    }
}
