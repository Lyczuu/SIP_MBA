<?php

namespace App\Exports;


use Carbon\Carbon;
use App\Models\mitra;
use App\Models\paymentmba;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Concerns\Exportable;

class PaymentsExport
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    protected $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function generateExcelFile()
    {
        // **Load template dari storage**
        $templatePath = storage_path('app/templates/layoutexcel.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception("Template Excel tidak ditemukan di: $templatePath");
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // **Ambil data dari database**
        $payments = PaymentMBA::whereIn('id', $this->ids)
            ->with(['User', 'mitra', 'wilayah', 'jenis_transaksi', 'PengajuanIntegrasi', 'fees'])
            ->get();

        // **Mulai menulis data dari baris ke-10**
        $row = 10;
        foreach ($payments as $payment) {
            $sheet->setCellValue("F34", $payment->kode_pengajuan);

            $sheet->setCellValue("F3", $payment->User->username ?? '');
            $sheet->setCellValue("F4", $payment->User->alamat ?? '');
            $sheet->setCellValue("F5", $payment->User->phone_number ?? '');
            $sheet->setCellValue("F6", $payment->User->email ?? '');

            $sheet->setCellValue("F31", $payment->wilayah->nama_wilayah ?? '');



            switch ($payment->transaksi_id) {
                case 1:
                    $sheet->setCellValue("B15", $payment->jenis_transaksi->nama_jenis_transaksi ?? '');
                    break;
                case 2:
                    $sheet->setCellValue("B15", $payment->jenis_transaksi->nama_jenis_transaksi ?? '');
                    break;
                case 3:
                    $sheet->setCellValue("B15", $payment->jenis_transaksi->nama_jenis_transaksi ?? '');
                    break;
                case 4:
                    $sheet->setCellValue("B15", $payment->jenis_transaksi->nama_jenis_transaksi ?? '');
                    break;
            }

            $sheet->setCellValue("F8", $payment->mitra->nama_mitra ?? '');


            // Ambil nama mitra berdasarkan ID yang tersimpan di mitra_agg
            $mitraAgg = mitra::find($payment->mitra_agg)?->nama_mitra ?? '';

            // Cetak nama mitra ke Excel
            $sheet->setCellValue("F9", $mitraAgg);



            //  field jenis_pajak_id tidak null atau kosong
            $jenisPajakArray = $payment->jenis_pajak_id ? explode(',', $payment->jenis_pajak_id) : [];

            // Mapping ID ke nama jenis pajak
            $jenisPajakMapping = [
                1 => 'PBB INDIVIDU',
                2 => 'PBB KOLEKTIF',
                3 => 'BPHTB',
                4 => 'PDL',
                5 => 'RETRIBUSI' // data jenis pajak
            ];

            // Misalnya, jika ingin menampilkan di sel-sel tertentu:
            $sheet->setCellValue("A12", in_array(1, $jenisPajakArray) ? $jenisPajakMapping[1] : '');
            $sheet->setCellValue("A13", in_array(2, $jenisPajakArray) ? $jenisPajakMapping[2] : '');
            $sheet->setCellValue("E12", in_array(3, $jenisPajakArray) ? $jenisPajakMapping[3] : '');
            $sheet->setCellValue("E13", in_array(4, $jenisPajakArray) ? $jenisPajakMapping[4] : '');
            $sheet->setCellValue("I12", in_array(5, $jenisPajakArray) ? $jenisPajakMapping[5] : '');




            $sheet->setCellValue("F33", $payment->PengajuanIntegrasi->nama_pengajuan_integrasi ?? '');

            $sheet->setCellValue("F36", $payment->cutoff ? Carbon::parse($payment->cutoff)->format('H:i') : '');
            $sheet->setCellValue("F37", $payment->settlement ? Carbon::parse($payment->settlement)->format('H:i') : '');

            $sheet->setCellValue("F17", $payment->nomor_registrasi_legal ?? '');


            $sheet->setCellValue("A29", $payment->fees->total_fee ?? '');
            $sheet->setCellValue("E29", $payment->fees->fee_mba ?? '');
            $sheet->setCellValue("H29", $payment->fees->fee_mitra ?? '');


            $sheet->setCellValue("A20", $payment->pic_payment_mitra ?? '');
            $sheet->setCellValue("E20", $payment->pic_rekon_mitra ?? '');
            $sheet->setCellValue("H20", $payment->pic_dinas ?? '');


            $sheet->setCellValue("A23", $payment->telepon_payment_mitra ?? '');
            $sheet->setCellValue("E23", $payment->telepon_rekon_mitra ?? '');
            $sheet->setCellValue("H23", $payment->telepon_dinas ?? '');


            $sheet->setCellValue("A26", $payment->wag_kordinasi_payment ?? '');
            $sheet->setCellValue("H26", $payment->wag_kordinasi_rekon ?? '');
            // $sheet->setCellValue("", $payment->nama_mitra ?? '');

            $sheet->setCellValue("F39", $payment->status == 0 ? 'Di Ajukan' : ($payment->status == 1 ? 'Ditolak' : ($payment->status == 2 ? 'Disetujui' : '')));
            $sheet->setCellValue("F40", $payment->jenis_pengajuan == 1 ? 'Fee Based (Admin)' : 'No Fee Based (Admin)');
            $row++;
        }

        return $spreadsheet; // Kembalikan objek Spreadsheet
    }
}
