<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\mitra;
use App\Models\ditolak;
use App\Models\wilayah;
use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Models\jenistransaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class AdmindashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentMba::with('mitraAgg') // Relasi agar efisien
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc');

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
            $item->jenis_pajak_nama = JenisPajak::whereIn('id', $jenisPajakIds)
                ->pluck('nama_jenis_pajak')
                ->implode(', ');

            $item->nama_mitra_agg = $item->mitraAgg?->nama_mitra ?? '-';

            $item->total_fee = $item->fees?->total_fee ?? '-';
            $item->fee_mba = $item->fees?->fee_mba ?? '-';
            $item->fee_mitra = $item->fees?->fee_mitra ?? '-';

            return $item;
        });

        $user = Auth::user();

        $totalPengajuanPerAM = User::leftJoin('payment_mba', 'users.id', '=', 'payment_mba.user_id')
            ->whereIn('users.id', [2, 3, 4, 5, 6])
            ->select('users.id as am_id', 'users.username', DB::raw('COUNT(payment_mba.id) as total_pengajuan'))
            ->groupBy('users.id', 'users.username')
            ->get();

        $kode_pengajuan = PaymentMba::select('kode_pengajuan')
            ->get()
            ->map(function ($item) {
                if (preg_match('/^([A-Z]{2}\d*)/', $item->kode_pengajuan, $matches)) {
                    return $matches[1];
                }
                return substr($item->kode_pengajuan, 0, 3);
            })
            ->unique()
            ->values();

        $nama_mitra = mitra::all();
        $wilayah = wilayah::all();
        $jenis_transaksi = jenistransaksi::all();
        $ditolak = ditolak::with('user')->get();

        return view('admin2.homeadmin0', compact(
            'paymentmba',
            'user',
            'totalPengajuanPerAM',
            'kode_pengajuan',
            'nama_mitra',
            'wilayah',
            'jenis_transaksi',
            'ditolak'
        ));
    }

}
