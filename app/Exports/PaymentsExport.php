<?php

namespace App\Exports;


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
            $sheet->setCellValue("E38", $payment->kode_pengajuan);

            $sheet->setCellValue("F3", $payment->User->username ?? '');
            $sheet->setCellValue("F4", $payment->User->alamat ?? '');
            $sheet->setCellValue("F5", $payment->User->phone_number ?? '');
            $sheet->setCellValue("F6", $payment->User->email ?? '');

            $sheet->setCellValue("E35", $payment->wilayah->nama_wilayah ?? '');



            $checked = "☑"; // Simbol centang
            $unchecked = "☐"; // Simbol tidak tercentang



            $sheet->setCellValue("A16", $payment->transaksi_id == 1 ? $checked : $unchecked); // H2H
            $sheet->setCellValue("A17", $payment->transaksi_id == 2 ? $checked : $unchecked); // Virtual Account
            $sheet->setCellValue("G16", $payment->transaksi_id == 3 ? $checked : $unchecked); // QRIS Dinamis
            $sheet->setCellValue("G17", $payment->transaksi_id == 4 ? $checked : $unchecked); // Loket


            $sheet->setCellValue("F8", $payment->mitra->nama_mitra ?? '');


            // Ambil nama mitra berdasarkan ID yang tersimpan di mitra_agg
            $mitraAgg = \App\Models\Mitra::find($payment->mitra_agg)?->nama_mitra ?? '';

            // Cetak nama mitra ke Excel
            $sheet->setCellValue("F9", $mitraAgg);



            $jenisPajakArray = explode(',', $payment->jenis_pajak_id);  //jenis pajak




            $sheet->setCellValue("A12", in_array(1, $jenisPajakArray) ? $checked : $unchecked); // PPN
            $sheet->setCellValue("A13", in_array(2, $jenisPajakArray) ? $checked : $unchecked); // PPh 21
            $sheet->setCellValue("A14", in_array(3, $jenisPajakArray) ? $checked : $unchecked); // PPh 21
            $sheet->setCellValue("E12", in_array(4, $jenisPajakArray) ? $checked : $unchecked); // PPh 22
            $sheet->setCellValue("E13", in_array(5, $jenisPajakArray) ? $checked : $unchecked); // PPh 23





            $sheet->setCellValue("E37", $payment->PengajuanIntegrasi->nama_pengajuan_integrasi ?? '');
            $sheet->setCellValue("F40", $payment->cutoff ?? '');
            $sheet->setCellValue("F41", $payment->settlement ?? '');

            $sheet->setCellValue("F20", $payment->nomor_registrasi_legal ?? '');


            $sheet->setCellValue("A33", $payment->fees->total_fee ?? '');
            $sheet->setCellValue("E33", $payment->fees->fee_mba ?? '');
            $sheet->setCellValue("H33", $payment->fees->fee_mitra ?? '');


            $sheet->setCellValue("A24", $payment->pic_payment_mitra ?? '');
            $sheet->setCellValue("E24", $payment->pic_rekon_mitra ?? '');
            $sheet->setCellValue("H24", $payment->pic_dinas ?? '');


            $sheet->setCellValue("A27", $payment->telepon_payment_mitra ?? '');
            $sheet->setCellValue("E27", $payment->telepon_rekon_mitra ?? '');
            $sheet->setCellValue("H27", $payment->telepon_dinas ?? '');


            $sheet->setCellValue("A30", $payment->wag_kordinasi_payment ?? '');
            $sheet->setCellValue("H30", $payment->wag_kordinasi_rekon ?? '');
            // $sheet->setCellValue("", $payment->nama_mitra ?? '');

            $sheet->setCellValue("F43", $payment->status == 0 ? 'Di Ajukan' : ($payment->status == 1 ? 'Ditolak' : ($payment->status == 2 ? 'Diterima' : '')));
            $sheet->setCellValue("F44", $payment->jenis_pengajuan == 1 ? 'Fee Based (Admin)' : 'No Fee Based (Admin)');
            $row++;
        }

        return $spreadsheet; // Kembalikan objek Spreadsheet
    }
}
