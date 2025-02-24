<?php

namespace App\Http\Controllers;



use App\Models\fees;
use App\Models\mitra;
use App\Models\wilayah;
use App\Models\paymentmba;
use App\Models\jenis_pajak;
use Illuminate\Http\Request;
use App\Models\jenis_transaksi;
use App\Models\pengajuanintegrasi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class PaymentmbaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Ambil user yang sedang login

        if (!$user) {
            abort(403, 'User tidak ditemukan atau tidak memiliki akses.');
        }

        $wilayah = $user->wilayah; // Ambil wilayah sesuai dengan user yang login
        $mitra = mitra::all();
        $jenis_pajak = jenis_pajak::all();
        $mitras = Mitra::where('flag_agg', 1)->get();
        $jenis_transaksi = jenis_transaksi::all();
        $fees = fees::all();
        $pengajuanintegrasi = pengajuanintegrasi::all();

        return view('admin.payment_mba_admin', compact('wilayah', 'mitra', 'jenis_pajak', 'jenis_transaksi', 'fees', 'pengajuanintegrasi', 'mitras'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {

        $jenisPajak = jenis_pajak::all(); //tabel di model


        // Kirim data ke view
        return view('admin.payment_mba_admin', compact('jenisPajak', 'jenis_transaksi'));
    }

    public function __construct()
    {
        $this->middleware('auth')->only(['store']); // Hanya metode 'store' yang dilindungi oleh auth
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Cek ID user yang sedang login
        $userId = Auth::id();
        logger()->info('User ID:', ['user_id' => $userId]);

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Tambahkan log awal untuk memantau proses
        logger()->info('Memulai proses penyimpanan data.');

        logger()->info('User ID:', ['user_id' => Auth::id()]);

        // Generate kode pengajuan dan tambahkan ke request
        $latestPayment = PaymentMba::latest('id')->first();
        $kode_pengajuan = 'AMK-' . str_pad(($latestPayment ? $latestPayment->id + 1 : 1), 5, '0', STR_PAD_LEFT);

        $request->merge([
            'kode_pengajuan' => $kode_pengajuan,
        ]);

        Log::info('Request data:', $request->all());

        // Validasi data
        $validated = $request->validate([
            'wilayah_id' => 'required|integer|exists:wilayah,id',
            'mitra_agg' => 'nullable|string',
            'mitra_id' => 'required|integer|exists:mitra,id',
            'kode_pengajuan' => 'required|string|max:255',
            'pengajuan_integrasi_id' => 'required|integer|exists:pengajuan_integrasi,id',
            'transaksi_id' => 'required|integer|exists:jenis_transaksi,id',
            'jenis_pajak' => 'array|required', // Wajib diisi sebagai array
            'jenis_pajak.*' => 'exists:jenis_pajak,id', // Pastikan ID valid di tabel jenis_pajak
            'cutoff' => 'required|string|max:255',
            'jenis_pengajuan' => 'required|string|max:255',
            'settlement' => 'required|string|max:255',
            'nomor_registrasi_legal' => 'required|string|max:255',
            'fees' => 'required|numeric',
            'fee_mba' => 'required|numeric',
            'fee_mitra' => 'required|numeric',
            'pic_payment_mitra' => 'required|string|max:255',
            'telepon_payment_mitra' => 'required|string',
            'pic_rekon_mitra' => 'required|string|max:255',
            'telepon_rekon_mitra' => 'required|string',
            'pic_dinas' => 'required|string|max:255',
            'telepon_dinas' => 'required|string',
            'wag_kordinasi_payment' => 'required|string|max:255',
            'wag_kordinasi_rekon' => 'required|string|max:255',
        ]);
        $jenisPajakStr = isset($validated['jenis_pajak']) ? implode(',', $validated['jenis_pajak']) : null;


        if (!$request->has('transaksi_id')) {
            Log::error('transaksi_id tidak terkirim dalam request!');
        }
        // dd($request);

        // Cek apakah pengajuan_integrasi_id ada
        Log::info('Pengajuan Integrasi ID:', ['pengajuan_integrasi_id' => $validated['pengajuan_integrasi_id']]);

        // Log input yang diterima
        Log::info('Data request:', $request->all());

        // Log untuk memastikan mitra_agg terisi
        Log::info('Data mitra_agg:', ['mitra_agg' => $validated['mitra_agg']]);

        $validated['jenis_pajak'] = json_encode($validated['jenis_pajak']);

        // Log untuk memeriksa data yang divalidasi
        logger()->info('Data yang divalidasi:', $validated);

        // Mulai transaksi DB
        DB::beginTransaction();

        try {
            $feeData = [
                'total_fee' => $validated['fees'] ?? 0, // Gunakan 0 jika tidak ada nilai
                'fee_mba' => $validated['fee_mba'] ?? 0,
                'fee_mitra' => $validated['fee_mitra'] ?? 0,
            ];

            // Filter hanya kolom yang memiliki nilai
            $feeData = array_filter($feeData, function ($value) {
                return !is_null($value);
            });

            $fee = Fees::create($feeData);


            // Ambil ID terakhir dan buat kode_pengajuan baru
            $latestPayment = PaymentMba::latest('id')->first();
            $kode_pengajuan = 'AM-' . str_pad(($latestPayment ? $latestPayment->id + 1 : 1), 5, '0', STR_PAD_LEFT);

            // Simpan data ke tabel payment_mba
            $data = PaymentMba::create([
                'wilayah_id' => $validated['wilayah_id'],
                'mitra_id' => $validated['mitra_id'],
                'kode_pengajuan' => $kode_pengajuan,
                'pengajuan_integrasi_id' => $validated['pengajuan_integrasi_id'],
                'jenis_pengajuan' => $validated['jenis_pengajuan'],
                'cutoff' => $validated['cutoff'],
                'settlement' => $validated['settlement'],
                'nomor_registrasi_legal' => $validated['nomor_registrasi_legal'],
                'fees_id' => $fee->id,
                'pic_payment_mitra' => $validated['pic_payment_mitra'],
                'telepon_payment_mitra' => $validated['telepon_payment_mitra'],
                'pic_rekon_mitra' => $validated['pic_rekon_mitra'],
                'telepon_rekon_mitra' => $validated['telepon_rekon_mitra'],
                'pic_dinas' => $validated['pic_dinas'],
                'telepon_dinas' => $validated['telepon_dinas'],
                'transaksi_id' => $validated['transaksi_id'],
                'wag_kordinasi_payment' => $validated['wag_kordinasi_payment'],
                'wag_kordinasi_rekon' => $validated['wag_kordinasi_rekon'],
                'mitra_agg' => $validated['mitra_agg'],
                'jenis_pajak_id' => $jenisPajakStr,
                'user_id' => Auth::id(), // Simpan ID jenis pajak
            ]);
            $prefix = '';

            if (Auth::id() == 2) {
                $prefix = 'AM1-';
            } elseif (Auth::id() == 3) {
                $prefix = 'AM2-';
            } elseif (Auth::id() == 4) {
                $prefix = 'AM3-';
            } elseif (Auth::id() == 5) {
                $prefix = 'AM4-';
            } elseif (Auth::id() == 6) {
                $prefix = 'AMK-';
            } else {
                $prefix = 'AMK-'; // Default prefix if user_id does not match
            }
            $data->update([
                'Kode_pengajuan' => $prefix . str_pad($data->id, 5, '0', STR_PAD_LEFT),
            ]);
            logger()->info('Data PaymentMba berhasil disimpan.', ['payment_id' => $data->id]);

            // Commit transaksi
            DB::commit();

            return redirect()->route('success.page')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $e) {
            // Rollback jika terjadi error
            DB::rollBack();

            // Log error untuk debugging
            logger()->error("Terjadi kesalahan saat menyimpan data: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString(),
            ]);

            // Redirect kembali dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(paymentmba $paymentmba)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paymentmba $paymentmba)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, paymentmba $paymentmba)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paymentmba $paymentmba)
    {
        //
    }
}
