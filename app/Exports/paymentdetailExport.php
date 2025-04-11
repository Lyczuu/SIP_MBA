<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\mitra;
use App\Models\paymentmba;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;

class paymentdetailExport
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
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Payment');

        // Header kolom
        $headers = [
            'A1' => 'No.',
            'B1' => 'Nama Am',
            'C1' => 'Kode Pengajuan',
            'D1' => 'Nama Mitra',
            'E1' => 'Nama Wilayah',
            'F1' => 'Jenis Pajak',
            'G1' => 'Jenis Transaksi',
            'H1' => 'Cutt Off',
            'I1' => 'Settlement',
            'J1' => 'Nomor Registrasi',
            'K1' => 'Mitra Agg',
            'L1' => 'Pengajuan Integrasi',
            'M1' => 'Total Fee',
            'N1' => 'Fee Mba',
            'O1' => 'Fee Mitra',
            'P1' => 'Status',
            'Q1' => 'Jenis Pengajuan',
            'R1' => 'Pic Payment Mitra',
            'S1' => 'Telepon Payment Mitra',
            'T1' => 'Pic Rekon Mitra',
            'U1' => 'Telepon Rekon Mitra',
            'V1' => 'Pic Dinas',
            'W1' => 'Telepon Dinas',
            'X1' => 'Wag Kordinasi Payment',
            'Y1' => 'Wag Kordinasi Rekon',
        ];

        foreach ($headers as $cell => $label) {
            $sheet->setCellValue($cell, $label);

            $sheet->getStyle($cell)->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);
        }


        // Ambil data
        $payments = paymentmba::whereIn('id', $this->ids)
            ->with(['mitra','User','wilayah','jenis_transaksi','PengajuanIntegrasi','fees'])
            ->get();

        $row = 2;
        $no = 1;
        foreach ($payments as $payment) {
            $sheet->setCellValue("A{$row}", $no++);
            $sheet->setCellValue("B{$row}", $payment->kode_pengajuan);
            $sheet->setCellValue("C{$row}", $payment->User->username?? '');
            $sheet->setCellValue("D{$row}", $payment->mitra->nama_mitra ?? '');
            $sheet->setCellValue("E{$row}", $payment->wilayah->nama_wilayah ?? '');

          $jenisPajakArray = $payment->jenis_pajak_id ? explode(',', $payment->jenis_pajak_id) : [];

          $jenisPajakMapping = [
              1 => 'PBB INDIVIDU',
              2 => 'PBB KOLEKTIF',
              3 => 'BPHTB',
              4 => 'PDL',
              5 => 'RETRIBUSI'
          ];

          // Ambil semua label jenis pajak sesuai ID
          $jenisPajakLabels = [];
          foreach ($jenisPajakArray as $id) {
              if (isset($jenisPajakMapping[$id])) {
                  $jenisPajakLabels[] = $jenisPajakMapping[$id];
              }
          }

          // Gabungkan jadi string, pisahkan dengan koma
          $jenisPajakString = implode(', ', $jenisPajakLabels);

          // Simpan di Excel (misalnya di cell A12)
          $sheet->setCellValue("F{$row}", $jenisPajakString);


            $sheet->setCellValue("G{$row}", $payment->jenis_transaksi->nama_jenis_transaksi ?? '');
            $sheet->setCellValue("H{$row}", $payment->cutoff ? Carbon::parse($payment->cutoff)->format('H:i') : '');
            $sheet->setCellValue("I{$row}", $payment->settlement ? Carbon::parse($payment->settlement)->format('H:i') : '');
            $sheet->setCellValue("J{$row}", $payment->nomor_registrasi_legal ?? '');


             // Ambil nama mitra berdasarkan ID yang tersimpan di mitra_agg
             $mitraAgg = mitra::find($payment->mitra_agg)?->nama_mitra ?? '';

             // Cetak nama mitra ke Excel
             $sheet->setCellValue("K{$row}", $mitraAgg);


            $sheet->setCellValue("L{$row}", $payment->PengajuanIntegrasi->nama_pengajuan_integrasi?? '');
            $sheet->setCellValue("M{$row}", $payment->fees->total_fee ?? '');
            $sheet->setCellValue("N{$row}", $payment->fees->fee_mba ?? '');
            $sheet->setCellValue("O{$row}", $payment->fees->fee_mitra ?? '');
            $sheet->setCellValue("P{$row}", $payment->status == 0 ? 'Di Ajukan' : ($payment->status == 1 ? 'Ditolak' : ($payment->status == 2 ? 'Disetujui' : '')));
            $sheet->setCellValue("Q{$row}", $payment->jenis_pengajuan == 1 ? 'Fee Based (Admin)' : 'Non Fee Based (Admin)');
            $sheet->setCellValue("R{$row}", $payment->pic_payment_mitra ?? '');
            $sheet->setCellValue("S{$row}", $payment->telepon_payment_mitra ?? '');
            $sheet->setCellValue("T{$row}", $payment->pic_rekon_mitra ?? '');
            $sheet->setCellValue("U{$row}", $payment->telepon_rekon_mitra ?? '');
            $sheet->setCellValue("V{$row}", $payment->pic_dinas ?? '');
            $sheet->setCellValue("W{$row}", $payment->telepon_dinas ?? '');
            $sheet->setCellValue("X{$row}", $payment->wag_kordinasi_payment ?? '');
            $sheet->setCellValue("Y{$row}", $payment->wag_kordinasi_rekon ?? '');
            $row++;
        }

        return $spreadsheet;
    }

}
