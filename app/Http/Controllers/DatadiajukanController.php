<?php

namespace App\Http\Controllers;


use App\Models\mitra;
use App\Models\ditolak;
use App\Models\wilayah;
use App\Models\jenispajak;
use App\Models\paymentmba;
use App\Models\datadiajukan;
use Illuminate\Http\Request;
use App\Models\jenistransaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exports\paymentdetailExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DatadiajukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Controller data diajukan
    public function index(Request $request)
    {
        $query = PaymentMba::query();

        // Tambahkan filter status=0 di query utama
        $query->where('status', 0);

        // FILTERING
        if ($request->kode_pengajuan) {
            $query->where('kode_pengajuan', 'like', $request->kode_pengajuan . '%');
        }

        if ($request->nama_mitra) {
            // Filter berdasarkan mitra_id
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

            // Tambahkan nama mitra dari mitraAgg yang memiliki flag_agg = 1
            $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';

            return $item;
        });

        $ditolak = Ditolak::with('user')->get();

        $user = Auth::user();

        // Get the unique prefixes for the dropdown
        $kode_pengajuan = PaymentMba::select('kode_pengajuan')
            ->get()
            ->map(function ($item) {
                // Extract specific prefixes like AM1, AM2, etc.
                if (preg_match('/^([A-Z]{2}\d*)/', $item->kode_pengajuan, $matches)) {
                    return $matches[1];
                }
                return substr($item->kode_pengajuan, 0, 3); // Fallback to first 3 chars
            })
            ->unique()
            ->values();

        // Get data for other dropdowns
        $nama_mitra = Mitra::all();
        $wilayah = Wilayah::all();
        $jenis_transaksi = JenisTransaksi::all();

        // Tambahkan debug untuk melihat parameter request
        Log::info('Request parameters:', $request->all());

        return view('admin2.datadiajukan', compact('paymentmba', 'user', 'ditolak', 'kode_pengajuan', 'nama_mitra', 'wilayah', 'jenis_transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:1,2',
            'alasan_penolakan' => 'required_if:status,1',
        ]);

        return DB::transaction(function () use ($request, $id) {
            $payment = PaymentMba::findOrFail($id);
            $payment->status = $request->status;
            $payment->save();

            // Ambil ID admin yang sedang login
            $ADMINId = Auth::check() ? Auth::user()->id : null;

            if ($request->status == 1) {
                ditolak::updateOrCreate(
                    ['pengajuan_id' => $payment->id],
                    [
                        'alasan_penolakan' => $request->alasan_penolakan,
                        'ditolak_oleh' => $ADMINId,
                    ]
                );
            }

            Session::flash('status', 'success');
            Session::flash('message', 'Data Berhasil Di Validasi');
            return redirect('/datadiajukan');

        });
    }
}
