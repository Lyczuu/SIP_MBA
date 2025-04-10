<?php

namespace App\Http\Controllers;

use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Exports\PaymentsExport;
use App\Exports\paymentdetailExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DiterimaController extends Controller
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
        return view('admin.diterima', compact('paymentmba'));
    }

    public function export(Request $request)
    {
        $ids = $request->input('ids'); // Ambil data checkbox yang dipilih
        if (!$ids) {
            return redirect()->back()->with('error', 'Pilih minimal satu data untuk diekspor.');
        }

        $files = [];

        foreach ($ids as $id) {
            // Ambil data pembayaran berdasarkan ID
            $payment = PaymentMBA::where('id', $id)
                ->with(['User', 'mitra', 'wilayah', 'jenis_transaksi', 'PengajuanIntegrasi', 'fees'])
                ->first();

            if (!$payment) continue;

            // Buat instance PaymentsExport
            $export = new PaymentsExport([$id]); // Kirim ID sebagai array

            // Path output untuk setiap file
            $fileName = $payment->kode_pengajuan . ".xlsx";
            $outputPath = storage_path("app/templates/" . $fileName);

            // Buat file Excel dan simpan ke storage
            $spreadsheet = $export->generateExcelFile();
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save($outputPath);

            $files[] = $outputPath;
        }

        // Jika hanya satu file, langsung download
        if (count($files) === 1) {
            return response()->download($files[0])->deleteFileAfterSend(true);
        }

        // Jika lebih dari satu, buat ZIP
        $zipFileName = "exported_payments.zip";
        $zipPath = storage_path("app/templates/" . $zipFileName);

        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
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
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
