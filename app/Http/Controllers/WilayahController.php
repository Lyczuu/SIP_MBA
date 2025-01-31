<?php

namespace App\Http\Controllers\paymentmba;

use App\Models\wilayah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\paymentmba;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['wilayah'] = wilayah::all();
        return view('admin.payment_mba', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $wilayah = Wilayah::all();
        return view('admin.payment_mba', compact('wilayah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'wilayah_id' => 'required|exists:wilayah,id',

        ]);


        paymentmba::create([
            'wilayah_id' => $request->wilayah_id,

        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(wilayah $wilayah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(wilayah $wilayah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, wilayah $wilayah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(wilayah $wilayah)
    {
        //
    }
}
