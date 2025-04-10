<?php

namespace App\Http\Controllers;

use App\Models\mitra;
use App\Models\wilayah;
use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Models\jenistransaksi;
use App\Models\PengajuanIntegrasi;
use Illuminate\Support\Facades\DB;
use App\Exports\paymentdetailExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DitolakController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Mendapatkan ID user yang sedang login

        // Ambil daftar nama jenis pajak berdasarkan ID
        $allJenisPajak = JenisPajak::pluck('nama_jenis_pajak', 'id');

        // Ambil data PaymentMba dengan filter berdasarkan user yang login
        $paymentmba = PaymentMba::where('user_id', $userId)
            ->with(['ditolak.User', 'pengajuanIntegrasi', 'mitra', 'fees', 'mitraAgg'])
            ->get()
            ->map(function ($item) use ($allJenisPajak) {
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

                // Tambahkan properti nama_pengajuan_integrasi dari relasi pengajuanIntegrasi
                $item->nama_pengajuan_integrasi = $item->pengajuanIntegrasi?->nama_pengajuan_integrasi ?? '-';

                //  nama mitra
                $item->nama_mitra = $item->mitra?->nama_mitra ?? '-';
                $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';
                // Tambahkan properti total_fee, fee_mba, dan fee_mitra dari relasi fees
                $item->total_fee = $item->fees?->total_fee ?? '-';
                $item->fee_mba = $item->fees?->fee_mba ?? '-';
                $item->fee_mitra = $item->fees?->fee_mitra ?? '-';

                return $item;
            });

        $wilayah = wilayah::all();
        $jenistransaksi = jenistransaksi::all();
        $jenispajak = jenispajak::all();
        $mitra = mitra::all();
        $mitras = Mitra::where('flag_agg', 1)->get();
        $PengajuanIntegrasi = PengajuanIntegrasi::all();
        return view('admin.ditolak', compact('paymentmba', 'wilayah', 'jenistransaksi', 'jenispajak', 'mitras', 'mitra', 'PengajuanIntegrasi'));
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



    public function update(Request $request, $id)
    {


        $request->merge([
            'cutoff' => date('H:i', strtotime($request->cutoff)),
            'settlement' => date('H:i', strtotime($request->settlement)),
        ]);


        $validated = $request->validate([
            'wilayah_id' => 'required|exists:wilayah,id',
            'transaksi_id' => 'required|exists:jenis_transaksi,id',
            'mitra_id' => 'required|exists:mitra,id',
            'jenis_pajak' => 'required|array',
            'jenis_pajak.*' => 'integer|exists:jenis_pajak,id',
            'status'          => 'required|string|max:255',
            'pengajuan_integrasi_id' => 'required|exists:pengajuan_integrasi,id',
            'cutoff' => 'required|date_format:H:i',
            'settlement' => 'required|date_format:H:i',
            'nomor_registrasi_legal' => 'required|string',
            'total_fee' => 'required|numeric',
            'fee_mba' => 'required|numeric',
            'fee_mitra' => 'required|numeric',
            'pic_payment_mitra' => 'required|string',
            'telepon_payment_mitra' => 'required|string',
            'pic_rekon_mitra' => 'required|string',
            'telepon_rekon_mitra' => 'required|string',
            'pic_dinas' => 'required|string',
            'telepon_dinas' => 'required|string',
            'wag_kordinasi_payment' => 'required|string',
            'wag_kordinasi_rekon' => 'required|string',
        ]);
        // dd($request->all()); // Lihat data sebelum validasi

        $payment = paymentmba::findOrFail($id);

        try {
            DB::transaction(function () use ($validated, $payment) {
                $payment->update([
                    'wilayah_id' => $validated['wilayah_id'],
                    'transaksi_id' => $validated['transaksi_id'],
                    'mitra_id' => $validated['mitra_id'],
                    'jenis_pajak_id' => implode(',', $validated['jenis_pajak']),
                    'status'        => $validated['status'],
                    'pengajuan_integrasi_id' => $validated['pengajuan_integrasi_id'],
                    'cutoff' => $validated['cutoff'],
                    'settlement' => $validated['settlement'],
                    'nomor_registrasi_legal' => $validated['nomor_registrasi_legal'],
                    'total_fee' => $validated['total_fee'],
                    'fee_mba' => $validated['fee_mba'],
                    'fee_mitra' => $validated['fee_mitra'],
                    'pic_payment_mitra' => $validated['pic_payment_mitra'],
                    'telepon_payment_mitra' => $validated['telepon_payment_mitra'],
                    'pic_rekon_mitra' => $validated['pic_rekon_mitra'],
                    'telepon_rekon_mitra' => $validated['telepon_rekon_mitra'],
                    'pic_dinas' => $validated['pic_dinas'],
                    'telepon_dinas' => $validated['telepon_dinas'],
                    'wag_kordinasi_payment' => $validated['wag_kordinasi_payment'],
                    'wag_kordinasi_rekon' => $validated['wag_kordinasi_rekon'],
                ]);
            });
            Session::flash('status', 'success');
            Session::flash('message', 'Data Berhasil Di Perbarui');
            return redirect('/ditolak');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()]);
        }
    }
}
