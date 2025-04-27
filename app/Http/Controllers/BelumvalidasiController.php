<?php

namespace App\Http\Controllers;


use App\Models\mitra;
use App\Models\wilayah;
use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Models\belumvalidasi;
use App\Models\jenistransaksi;
use Illuminate\Routing\Controller;
use App\Exports\paymentdetailExport;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BelumvalidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Ambil daftar semua jenis pajak dalam bentuk [id => nama]
        $allJenisPajak = JenisPajak::pluck('nama_jenis_pajak', 'id');

        // Mulai query dengan user_id
        $query = PaymentMBA::where('user_id', $userId)
            ->with(['user', 'mitra', 'wilayah', 'jenis_transaksi', 'mitraAgg']); // Tambah relasi mitraAgg

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

        // Ambil hasil query dan modifikasi datanya
        $paymentmba = $query->get()->map(function ($item) use ($allJenisPajak) {
            // Mengonversi jenis_pajak_id (format CSV) menjadi array
            $jenisPajakIds = array_filter(array_map('trim', explode(',', $item->jenis_pajak_id ?? '')));

            // Mapping ID jenis pajak ke nama
            $item->jenis_pajak_nama = collect($jenisPajakIds)
                ->map(fn($id) => $allJenisPajak[$id] ?? null)
                ->filter()
                ->implode(', ') ?: '-';

            // Menambahkan nama_mitra dari mitraAgg yang memiliki flag_agg = 1
            $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';

            return $item;
        });



        $wilayah = wilayah::all();
        $jenistransaksi = jenistransaksi::all();
        $mitra = mitra::all();

        return view('admin.belumvalidasi', compact(
            'paymentmba',
            'wilayah',
            'jenistransaksi',
            'mitra'
        ));
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
    public function show( $belumvalidasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $belumvalidasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $belumvalidasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $belumvalidasi)
    {
        //
    }
}
