<?php

namespace App\Http\Controllers;

use App\Models\mitra;
use App\Models\ditolak;
use App\Models\wilayah;
use App\Models\jenispajak;
use App\Models\paymentmba;
use App\Models\dataditolak;
use Illuminate\Http\Request;
use App\Models\jenistransaksi;
use App\Exports\paymentdetailExport;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DataditolakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua jenis pajak untuk digunakan dalam mapping
    {
        $query = PaymentMba::with(['ditolak.User', 'pengajuanIntegrasi', 'mitra', 'fees', 'mitraAgg']);

        // FILTERING
        if ($request->kode_pengajuan) {
            $query->where('kode_pengajuan', 'like', $request->kode_pengajuan . '%');
        }

        if ($request->nama_mitra) {
            $query->where('mitra_id', $request->nama_mitra);
        }

        if ($request->wilayah) {
            $query->where('wilayah_id', $request->wilayah);
        }

        if ($request->jenis_transaksi) {
            $query->where('transaksi_id', $request->jenis_transaksi);
        }

        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $allJenisPajak = JenisPajak::pluck('nama_jenis_pajak', 'id');

        $paymentmba = $query->get()->map(function ($item) use ($allJenisPajak) {
            // Ubah jenis_pajak_id (string "1,2,3") menjadi array [1, 2, 3]
            $jenisPajakIds = array_filter(array_map('trim', explode(',', $item->jenis_pajak_id ?? '')));

            // Ambil nama jenis pajak berdasarkan ID
            $item->jenis_pajak_nama = collect($jenisPajakIds)
                ->map(fn($id) => $allJenisPajak[$id] ?? null)
                ->filter()
                ->implode(', ') ?: '-';

            // Tambahkan properti alasan_penolakan dari relasi ditolak
            $item->alasan_penolakan = $item->ditolak?->alasan_penolakan ?? '-';
            $item->ditolak_oleh = $item->ditolak?->User?->username ?? '-';

            $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';
            $item->nama_pengajuan_integrasi = $item->pengajuanIntegrasi?->nama_pengajuan_integrasi ?? '-';
            $item->nama_mitra = $item->mitra?->nama_mitra ?? '-';
            $item->total_fee = $item->fees?->total_fee ?? '-';
            $item->fee_mba = $item->fees?->fee_mba ?? '-';
            $item->fee_mitra = $item->fees?->fee_mitra ?? '-';

            return $item;
        });

        $user = Auth::user();

        $kode_pengajuan = PaymentMba::select('kode_pengajuan')
            ->get()
            ->map(function ($item) {
                if (preg_match('/^([A-Z]{2}\d*)/', $item->kode_pengajuan, $matches)) {
                    return $matches[1];
                }
                return substr($item->kode_pengajuan, 0, 3);
            })
            ->unique()
            ->values();

        $nama_mitra = mitra::all();
        $wilayah = wilayah::all();
        $jenis_transaksi = jenistransaksi::all();
        $ditolak = ditolak::with('user')->get();

        return view('admin2.dataditolak', compact('paymentmba', 'user', 'ditolak', 'kode_pengajuan', 'nama_mitra', 'wilayah', 'jenis_transaksi'));
    }

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
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(dataditolak $dataditolak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, dataditolak $dataditolak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dataditolak $dataditolak)
    {
        //
    }
}
