<?php

namespace App\Http\Controllers;

use App\Models\fees;
use App\Models\mitra;
use App\Models\ditolak;
use App\Models\wilayah;
use App\Models\paymentmba;
use App\Models\jenis_pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\jenis_transaksi;
use App\Models\datadetailpayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DatadetailpaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['datadetailpayment'] = datadetailpayment::all();
        $data['paymentmba'] = paymentmba::all();
        $data['wilayah'] = wilayah::get();
        $data['mitra'] = mitra::get();
        $data['jenis_pajak'] = jenis_pajak::all();
        $data['jenis_transaksi'] = jenis_transaksi::all();
        $data['fees'] = fees::all();

        return view('admin2.detailpayment', $data);
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
    public function show(datadetailpayment $datadetailpayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:1,2',
            'alasan_penolakan' => 'required_if:status,1',
        ]);

        return DB::transaction(function () use ($request, $id) {
            $payment = PaymentMba::findOrFail($id);
            $payment->status = $request->status;
            $payment->save();

            // Ambil ID admin yang sedang login
            $adminId = Auth::check() ? Auth::user()->id : null;

            if ($request->status == 1) {
                Ditolak::updateOrCreate(
                    ['pengajuan_id' => $payment->id],
                    [
                        'alasan_penolakan' => $request->alasan_penolakan,
                        'ditolak_oleh' => $adminId,
                    ]
                );
            }

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(datadetailpayment $datadetailpayment)
    {
        //
    }
}
