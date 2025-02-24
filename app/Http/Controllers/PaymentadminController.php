<?php

namespace App\Http\Controllers;

use App\Models\paymentadmin;
use Illuminate\Http\Request;

class PaymentadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('admin2.datapaymentadmin');
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
    public function show(paymentadmin $paymentadmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paymentadmin $paymentadmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, paymentadmin $paymentadmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paymentadmin $paymentadmin)
    {
        //
    }
}
