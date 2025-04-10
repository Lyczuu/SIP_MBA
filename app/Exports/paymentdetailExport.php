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
            'A1' => ['label' => 'Kode Pengajuan', 'color' => 'FF2196F3'], // biru
            'B1' => ['label' => 'Nama Am', 'color' => 'FF4CAF50'],        // hijau
            'C1' => ['label' => 'Nama Mitra', 'color' => 'FFFF9800'],     // oranye
            'D1' => ['label' => 'Nama Wilayah', 'color' => 'FF9C27B0'],   // ungu
            'E1' => ['label' => 'Jenis Pajak', 'color' => 'FF00BCD4'],    // toska
            'F1' => ['label' => 'Jenis Transaksi', 'color' => 'FF795548'],// coklat
            'G1' => ['label' => 'Cutt Off', 'color' => 'FF607D8B'],       // abu
            'H1' => ['label' => 'Settlement', 'color' => 'FF3F51B5'],
            'I1' => ['label' => 'Nomor Registrasi', 'color' => 'FFE91E63'],
            'J1' => ['label' => 'Mitra Agg', 'color' => 'FFCDDC39'],
            'K1' => ['label' => 'Pengajuan Integrasi', 'color' => 'FF009688'],
            'L1' => ['label' => 'Total Fee', 'color' => 'FF673AB7'],
            'M1' => ['label' => 'Fee Mba', 'color' => 'FFFF5722'],
            'N1' => ['label' => 'Fee Mitra', 'color' => 'FF8BC34A'],
            'O1' => ['label' => 'Status', 'color' => 'FF03A9F4'],
            'P1' => ['label' => 'Jenis Pengajuan', 'color' => 'FF9E9E9E'],
            'Q1' => ['label' => 'Pic Payment Mitra', 'color' => 'FF00BCD4'],
            'R1' => ['label' => 'Telepon Payment Mitra', 'color' => 'FF4CAF50'],
            'S1' => ['label' => 'Pic Rekon Mitra', 'color' => 'FFF44336'],
            'T1' => ['label' => 'Telepon Rekon Mitra', 'color' => 'FF009688'],
            'U1' => ['label' => 'Pic Dinas', 'color' => 'FF3F51B5'],
            'V1' => ['label' => 'Telepon Dinas', 'color' => 'FFFFC107'],
            'W1' => ['label' => 'Wag Kordinasi Payment', 'color' => 'FF795548'],
            'X1' => ['label' => 'Wag Kordinasi Rekon', 'color' => 'FF607D8B'],
        ];

        foreach ($headers as $cell => $info) {
            $sheet->setCellValue($cell, $info['label']);

            $sheet->getStyle($cell)->applyFromArray([
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => $info['color']],
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
        foreach ($payments as $payment) {
            $sheet->setCellValue("A{$row}", $payment->kode_pengajuan);
            $sheet->setCellValue("B{$row}", $payment->User->username?? '');
            $sheet->setCellValue("C{$row}", $payment->mitra->nama_mitra ?? '');
            $sheet->setCellValue("D{$row}", $payment->wilayah->nama_wilayah ?? '');

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
          $sheet->setCellValue("E{$row}", $jenisPajakString);


            $sheet->setCellValue("F{$row}", $payment->jenis_transaksi->nama_jenis_transaksi ?? '');
            $sheet->setCellValue("G{$row}", $payment->cutoff ? Carbon::parse($payment->cutoff)->format('H:i') : '');
            $sheet->setCellValue("H{$row}", $payment->settlement ? Carbon::parse($payment->settlement)->format('H:i') : '');
            $sheet->setCellValue("I{$row}", $payment->nomor_registrasi_legal ?? '');


             // Ambil nama mitra berdasarkan ID yang tersimpan di mitra_agg
             $mitraAgg = mitra::find($payment->mitra_agg)?->nama_mitra ?? '';

             // Cetak nama mitra ke Excel
             $sheet->setCellValue("J{$row}", $mitraAgg);


            $sheet->setCellValue("K{$row}", $payment->PengajuanIntegrasi->nama_pengajuan_integrasi?? '');
            $sheet->setCellValue("L{$row}", $payment->fees->total_fee ?? '');
            $sheet->setCellValue("M{$row}", $payment->fees->fee_mba ?? '');
            $sheet->setCellValue("N{$row}", $payment->fees->fee_mitra ?? '');
            $sheet->setCellValue("O{$row}", $payment->status == 0 ? 'Di Ajukan' : ($payment->status == 1 ? 'Ditolak' : ($payment->status == 2 ? 'Disetujui' : '')));
            $sheet->setCellValue("P{$row}", $payment->jenis_pengajuan == 1 ? 'Fee Based (Admin)' : 'Non Fee Based (Admin)');
            $sheet->setCellValue("Q{$row}", $payment->pic_payment_mitra ?? '');
            $sheet->setCellValue("R{$row}", $payment->telepon_payment_mitra ?? '');
            $sheet->setCellValue("S{$row}", $payment->pic_rekon_mitra ?? '');
            $sheet->setCellValue("T{$row}", $payment->telepon_rekon_mitra ?? '');
            $sheet->setCellValue("U{$row}", $payment->pic_dinas ?? '');
            $sheet->setCellValue("V{$row}", $payment->telepon_dinas ?? '');
            $sheet->setCellValue("W{$row}", $payment->wag_kordinasi_payment ?? '');
            $sheet->setCellValue("X{$row}", $payment->wag_kordinasi_rekon ?? '');
            $row++;
        }

        return $spreadsheet;
    }

}
