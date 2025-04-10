<?php

namespace App\Http\Controllers;


use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Models\belumvalidasi;
use Illuminate\Routing\Controller;
use App\Exports\paymentdetailExport;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BelumvalidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Ambil daftar semua jenis pajak dalam bentuk [id => nama]
        $allJenisPajak = JenisPajak::pluck('nama_jenis_pajak', 'id');

        // Ambil hanya data yang sesuai dengan user yang login
        $paymentmba = PaymentMBA::where('user_id', $userId)
            ->with(['user', 'mitra', 'wilayah', 'jenis_transaksi', 'mitraAgg']) // Tambah relasi mitraAgg
            ->get()
            ->map(function ($item) use ($allJenisPajak) {
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
        return view('admin.belumvalidasi', compact('paymentmba'));
    }

    public function exportdetail(Request $request)
    {
        $ids = $request->input('ids');

        if (!$ids) {
            return redirect()->back()->with('error', 'Pilih minimal satu data untuk diekspor.');
        }

        // Kirim semua ID ke Export
        $export = new paymentdetailExport($ids);

        // Buat file Excel-nya
        $spreadsheet = $export->generateExcelFile();
        $writer = new Xlsx($spreadsheet);

        // Simpan ke file sementara
        $fileName = 'exported_payments_' . now()->format('Ymd_His') . '.xlsx';
        $tempFilePath = storage_path('app/' . $fileName);
        $writer->save($tempFilePath);

        // Kembalikan file sebagai respons download
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
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
