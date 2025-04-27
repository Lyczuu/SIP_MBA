<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\mitra;
use App\Models\ditolak;
use App\Models\wilayah;
use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Models\jenistransaksi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Ambil daftar semua jenis pajak dalam bentuk [id => nama]
        $allJenisPajak = JenisPajak::pluck('nama_jenis_pajak', 'id');

        // Mulai query dengan user_id dan relasi
        $query = PaymentMBA::where('user_id', $userId)
            ->with(['user', 'mitra', 'wilayah', 'jenis_transaksi', 'mitraAgg']) // Tambahkan relasi mitraAgg
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc'); // Urutkan data berdasarkan waktu dibuat (paling baru di atas)

        // FILTERING berdasarkan request
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

        // Ambil hasil query yang sudah difilter dan modifikasi datanya
        $paymentmba = $query->get()->map(function ($item) use ($allJenisPajak) {
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

        // Hitung total pengajuan berdasarkan user yang login
        $totalpengajuan = $query->count();

        // Hitung total semua pengajuan dari semua user
        $totalSemuaPengajuan = PaymentMBA::count();

        // tidak terjadi pembagian dengan nol
        $persentasePengajuan = $totalSemuaPengajuan > 0
            ? ($totalpengajuan / $totalSemuaPengajuan) * 100
            : 0;

        // Hitung total mitra_agg
        $totalMitraAgg = $query->whereNotNull('mitra_agg') // Pastikan mitra_agg tidak NULL
            ->where('mitra_agg', '!=', '') // Pastikan mitra_agg tidak kosong
            ->whereRaw("mitra_agg REGEXP '^[0-9]+$'") // Hanya angka yang valid
            ->count();



        $wilayah = wilayah::all();
        $jenistransaksi = jenistransaksi::all();
        $mitra = mitra::all();

        return view('admin.dashboard', compact(
            'paymentmba',
            'totalpengajuan',
            'totalMitraAgg',
            'persentasePengajuan',
            'wilayah',
            'jenistransaksi',
            'mitra'
        ));
    }
}
