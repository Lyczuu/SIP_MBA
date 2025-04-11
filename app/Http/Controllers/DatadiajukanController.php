<?php

namespace App\Http\Controllers;


use App\Models\ditolak;
use App\Models\jenispajak;
use App\Models\paymentmba;
use App\Models\datadiajukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\paymentdetailExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DatadiajukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentmba = PaymentMba::all()->map(function ($item) {
            $jenisPajakIds = explode(',', $item->jenis_pajak_id);
            $item->jenis_pajak_nama = JenisPajak::whereIn('id', $jenisPajakIds)->pluck('nama_jenis_pajak')->implode(', ');

            // Tambahkan nama mitra dari mitraAgg yang memiliki flag_agg = 1
            $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';

            return $item;
        });

        $ditolak = ditolak::with('user')->get();
        $user = Auth::user();

        return view('admin2.datadiajukan', compact('paymentmba', 'user'));
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
    public function show($datadiajukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $datadiajukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
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
            $ADMINId = Auth::check() ? Auth::user()->id : null;

            if ($request->status == 1) {
                ditolak::updateOrCreate(
                    ['pengajuan_id' => $payment->id],
                    [
                        'alasan_penolakan' => $request->alasan_penolakan,
                        'ditolak_oleh' => $ADMINId,
                    ]
                );
            }

            Session::flash('status','success');
            Session::flash('message','Data Berhasil Di Validasi');
            return redirect('/datadiajukan');

        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $datadiajukan)
    {
        //
    }
}
