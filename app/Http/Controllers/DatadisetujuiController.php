<?php

namespace App\Http\Controllers;


use App\Models\ditolak;
use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Models\datadisetujui;
use App\Exports\PaymentsExport;
use Illuminate\Support\Facades\Auth;

class DatadisetujuiController extends Controller
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

        $ditolak = Ditolak::with('user')->get();
        $user = Auth::user();
        $paymentmbafee = PaymentMBA::where('user_id', $user->id)->get();

        return view('admin2.datadisetujui', compact('paymentmba', 'paymentmbafee', 'user', 'ditolak'));

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

            // **Buat instance PaymentsExport**
            $export = new PaymentsExport([$id]); // Kirim ID sebagai array

            // **Path output untuk setiap file**
            $fileName = $payment->kode_pengajuan . ".xlsx";
            $outputPath = storage_path("app/templates/" . $fileName);

            // **Buat file Excel dan simpan ke storage**
            $spreadsheet = $export->generateExcelFile();
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save($outputPath);

            $files[] = $outputPath;
        }

        // **Jika hanya satu file, langsung download**
        if (count($files) === 1) {
            return response()->download($files[0])->deleteFileAfterSend(true);
        }

        // **Jika lebih dari satu, buat ZIP**
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
    public function show( $datadisetujui)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($datadisetujui)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $datadisetujui)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $datadisetujui)
    {
        //
    }
}
