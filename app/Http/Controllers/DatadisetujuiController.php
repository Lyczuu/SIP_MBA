<?php

namespace App\Http\Controllers;


use App\Models\mitra;
use App\Models\ditolak;
use App\Models\wilayah;
use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Models\datadisetujui;
use App\Models\jenistransaksi;
use App\Exports\PaymentsExport;
use App\Exports\paymentdetailExport;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DatadisetujuiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PaymentMba::query();

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


        $paymentmba = $query->get()->map(function ($item) {
            $jenisPajakIds = explode(',', $item->jenis_pajak_id);
            $item->jenis_pajak_nama = JenisPajak::whereIn('id', $jenisPajakIds)->pluck('nama_jenis_pajak')->implode(', ');

            // Jika ingin tetap menampilkan nama mitra, bisa gunakan relasi
            $mitra = Mitra::find($item->mitra_id);
            $item->nama_mitra_agg = $mitra ? $mitra->nama_mitra : '-';

            $item->total_fee = $item->fees ? $item->fees->total_fee : '-';
            $item->fee_mba = $item->fees ? $item->fees->fee_mba : '-';
            $item->fee_mitra = $item->fees ? $item->fees->fee_mitra : '-';

            return $item;
        });

        $user = Auth::user();

        $paymentmbafee = PaymentMBA::where('user_id', $user->id)->get();

        $kode_pengajuan = PaymentMba::select('kode_pengajuan')
            ->get()
            ->map(function ($item) {
                // This will extract specific prefixes like AM1, AM2, etc.
                if (preg_match('/^([A-Z]{2}\d*)/', $item->kode_pengajuan, $matches)) {
                    return $matches[1];
                }
                return substr($item->kode_pengajuan, 0, 3); // Fallback to first 3 chars
            })
            ->unique()
            ->values();

        $nama_mitra = Mitra::all();

        $wilayah = Wilayah::all();

        $jenis_transaksi = JenisTransaksi::all();


        return view('admin2.datadisetujui', compact('paymentmba', 'paymentmbafee', 'user',  'kode_pengajuan', 'nama_mitra', 'wilayah', 'jenis_transaksi'));
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

            if (!$payment)
                continue;

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
    public function show($datadisetujui)
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
    public function destroy($datadisetujui)
    {
        //
    }
}
