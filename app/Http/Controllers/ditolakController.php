<?php

namespace App\Http\Controllers;

use App\Models\fees;
use App\Models\paymentmba;
use App\Models\jenis_pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ditolakController extends Controller
{
    public function index()
    {
        $paymentmba = PaymentMba::all()->map(function ($item) {
            $jenisPajakIds = explode(',', $item->jenis_pajak_id);
            $item->jenis_pajak_nama = jenis_pajak::whereIn('id', $jenisPajakIds)->pluck('nama_jenis_pajak')->implode(', ');
            return $item;
        });
        $user = Auth::user();
        $paymentmba = PaymentMBA::where('user_id', $user->id)->get();

        return view('admin.ditolak',compact('paymentmba'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'nama_wilayah' => 'required|string|max:255',
            'nama_jenis_pajak' => 'required|string|max:255',
            'nama_jenis_transaksi' => 'required|string|max:255',
            'cutoff' => 'required|string|max:255',
            'settlement' => 'required|string|max:255',
            'nomor_registrasi_legal' => 'required|string|max:255',
            'mitra_agg' => 'required|string|max:255',
            'pengajuan_integrasi' => 'required|string|max:255',
            'total_fee' => 'required|numeric',
            'fee_mba' => 'required|numeric',
            'fee_mitra' => 'required|numeric',
            'pic_payment_mitra' => 'required|string|max:255',
            'telepon_payment_mitra' => 'required|string|max:255',
            'pic_rekon_mitra' => 'required|string|max:255',
            'telepon_rekon_mitra' => 'required|string|max:255',
            'pic_dinas' => 'required|string|max:255',
            'telepon_dinas' => 'required|string|max:255',
            'wag_kordinasi_payment' => 'required|string|max:255',
            'wag_kordinasi_rekon' => 'required|string|max:255',
        ]);

        // Update PaymentMba record
        $payment = PaymentMba::findOrFail($id);
        $payment->update([
            'nama_mitra' => $request->nama_mitra,
            'nama_wilayah' => $request->nama_wilayah,
            'jenis_pajak_id' => $request->nama_jenis_pajak,
            'jenis_transaksi_id' => $request->nama_jenis_transaksi,
            'cutoff' => $request->cutoff,
            'settlement' => $request->settlement,
            'nomor_registrasi_legal' => $request->nomor_registrasi_legal,
            'mitra_agg' => $request->mitra_agg,
            'pengajuan_integrasi' => $request->pengajuan_integrasi,
            'pic_payment_mitra' => $request->pic_payment_mitra,
            'telepon_payment_mitra' => $request->telepon_payment_mitra,
            'pic_rekon_mitra' => $request->pic_rekon_mitra,
            'telepon_rekon_mitra' => $request->telepon_rekon_mitra,
            'pic_dinas' => $request->pic_dinas,
            'telepon_dinas' => $request->telepon_dinas,
            'wag_kordinasi_payment' => $request->wag_kordinasi_payment,
            'wag_kordinasi_rekon' => $request->wag_kordinasi_rekon,
        ]);

        // Update Fees record
        $fees = fees::where('payment_mba_id', $id)->first();
        if ($fees) {
            $fees->update([
                'total_fee' => $request->total_fee,
                'fee_mba' => $request->fee_mba,
                'fee_mitra' => $request->fee_mitra,
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }
}

