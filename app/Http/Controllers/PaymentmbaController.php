<?php

namespace App\Http\Controllers;



use App\Models\fees;
use App\Models\mitra;
use App\Models\wilayah;
use App\Models\paymentmba;
use App\Models\jenis_pajak;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\jenis_transaksi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentmbaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['paymentmba'] = paymentmba::all();
        $data['wilayah'] = wilayah::get();
        $data['mitra'] = mitra::get();
        $data['jenis_pajak'] = jenis_pajak::all();
        $data['jenis_transaksi'] = jenis_transaksi::all();
        $data['fees'] = fees::all();

        return view('admin.payment_mba_admin', $data);
    }



    public function showAlerts()
    {
        $wilayah = Wilayah::all();
        $mitra = mitra::all();
        $jenis_pajak = jenis_pajak::all();
        $jenis_transaksi = jenis_transaksi::all();
        $fees = fees::all();

        return view('admin.payment_mba_admin',  compact('wilayah', 'mitra', 'jenis_pajak', 'jenis_transaksi', 'fees'));
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
        $kodePengajuan = 'AMK-' . str_pad(($latestPayment ? $latestPayment->id + 1 : 1), 5, '0', STR_PAD_LEFT);

        $request->merge([
            'Kode_pengajuan' => $kodePengajuan,
        ]);


        // Validasi data
        $validated = $request->validate([
            'wilayah_id' => 'required|integer|exists:wilayah,id',
            'mitra_agg' => 'nullable|string',
            'mitra_id' => 'required|integer|exists:mitra,id',
            'Kode_pengajuan' => 'required|string|max:255',
            'Pengajuan_integrasi' => 'required|string|in:Development,SIT',
            'jenis_pajak' => 'required|array|min:1', // Pastikan ini adalah array
            'jenis_pajak.*' => 'integer|exists:jenis_pajak,id',
            'transaksi_id' => 'required|integer|exists:jenis_transaksi,id', // Validasi tiap ID harus ada di tabel jenis_pajak
            'Cutoff' => 'required|string|max:255',
            'Settlement' => 'required|string|max:255',
            'Nomor_Registrasi_Legal' => 'required|string|max:255',
            'fees' => 'required|numeric',
            'Fee_mba' => 'required|numeric',
            'Fee_mitra' => 'required|numeric',
            'PIC_Payment_Mitra' => 'required|string|max:255',
            'telepon_payment_mitra' => 'required|string',
            'PIC_Rekon_Mitra' => 'required|string|max:255',
            'telepon_rekon_mitra' => 'required|string',
            'PIC_Dinas' => 'required|string|max:255',
            'telepon_dinas' => 'required|string',
            'WAG_KORDINASI_PAYMENT' => 'required|string|max:255',
            'WAG_KORDINASI_REKON' => 'required|string|max:255',
        ]);
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
                'Total_Fee' => $validated['fees'] ?? 0, // Gunakan 0 jika tidak ada nilai
                'Fee_mba' => $validated['Fee_mba'] ?? 0,
                'Fee_mitra' => $validated['Fee_mitra'] ?? 0,
            ];

            // Filter hanya kolom yang memiliki nilai
            $feeData = array_filter($feeData, function ($value) {
                return !is_null($value);
            });

            $fee = Fees::create($feeData);


            // Ambil ID terakhir dan buat kode_pengajuan baru
            $latestPayment = PaymentMba::latest('id')->first();
            $kodePengajuan = 'AM-' . str_pad(($latestPayment ? $latestPayment->id + 1 : 1), 5, '0', STR_PAD_LEFT);

            // Simpan data ke tabel payment_mba
            $data = PaymentMba::create([
                'wilayah_id' => $validated['wilayah_id'],
                'mitra_id' => $validated['mitra_id'],
                'Kode_pengajuan' => $kodePengajuan,
                'Pengajuan_integrasi' => $validated['Pengajuan_integrasi'],
                'Cutoff' => $validated['Cutoff'],
                'Settlement' => $validated['Settlement'],
                'Nomor_Registrasi_Legal' => $validated['Nomor_Registrasi_Legal'],
                'fees_id' => $fee->id,
                'PIC_Payment_Mitra' => $validated['PIC_Payment_Mitra'],
                'telepon_payment_mitra' => $validated['telepon_payment_mitra'],
                'PIC_Rekon_Mitra' => $validated['PIC_Rekon_Mitra'],
                'telepon_rekon_mitra' => $validated['telepon_rekon_mitra'],
                'PIC_Dinas' => $validated['PIC_Dinas'],
                'telepon_dinas' => $validated['telepon_dinas'],
                'transaksi_id' => $validated['transaksi_id'],
                'WAG_KORDINASI_PAYMENT' => $validated['WAG_KORDINASI_PAYMENT'],
                'WAG_KORDINASI_REKON' => $validated['WAG_KORDINASI_REKON'],
                'mitra_agg' => $validated['mitra_agg'],
                'jenis_pajak_id' => $validated['jenis_pajak'],
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
