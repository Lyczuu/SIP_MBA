<?php

namespace App\Http\Controllers;



use App\Models\fees;
use App\Models\mitra;
use App\Models\jenispajak;
use App\Models\paymentmba;
use Illuminate\Http\Request;
use App\Exports\PaymentsExport;
use App\Models\jenis_transaksi;
use App\Models\pengajuanintegrasi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

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
        $jenis_pajak = jenispajak::all();
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

        $jenisPajak = jenispajak::all(); //tabel di model


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
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        Log::info('User ID: ' . Auth::id());
        Log::info('Memulai proses penyimpanan data.');

        // Validasi data yang diterima, perhatikan bahwa nama field fee disesuaikan dengan blade (total_fee)
        $validated = $request->validate([
            'wilayah_id'               => 'required|integer|exists:wilayah,id',
            'mitra_agg'                => 'nullable|string',
            'mitra_id'                 => 'required|integer|exists:mitra,id',
            'pengajuan_integrasi_id'   => 'required|integer|exists:pengajuan_integrasi,id',
            'transaksi_id'             => 'required|integer|exists:jenis_transaksi,id',
            'jenis_pajak'              => 'required|array',
            'jenis_pajak.*'            => 'exists:jenis_pajak,id',
            'cutoff'                   => 'required|string|max:255',
            'jenis_pengajuan'          => 'required|string|max:255',
            'settlement'               => 'required|string|max:255',
            'nomor_registrasi_legal'   => 'required|numeric',
            'total_fee'                => 'required|numeric',
            'fee_mba'                  => 'required|numeric',
            'fee_mitra'                => 'required|numeric',
            'pic_payment_mitra'        => 'required|numeric',
            'telepon_payment_mitra'    => 'required|string',
            'pic_rekon_mitra'          => 'required|string|max:255',
            'telepon_rekon_mitra'      => 'required|numeric',
            'pic_dinas'                => 'required|string|max:255',
            'telepon_dinas'            => 'required|numeric',
            'wag_kordinasi_payment'    => 'required|string|max:255',
            'wag_kordinasi_rekon'      => 'required|string|max:255',
        ]);
        $jenisPajakStr = isset($validated['jenis_pajak']) ? implode(',', $validated['jenis_pajak']) : null;

        Log::info('Data yang divalidasi:', $validated);

        // Ubah array jenis_pajak menjadi JSON string jika diperlukan penyimpanan sebagai string


        DB::beginTransaction();
        try {
            // Simpan data fee berdasarkan input yang sudah divalidasi
            $feeData = [
                'total_fee' => $validated['total_fee'],
                'fee_mba'   => $validated['fee_mba'],
                'fee_mitra' => $validated['fee_mitra'],
            ];
            $fee = Fees::create($feeData);

            // Simpan data PaymentMba, kode_pengajuan akan diupdate setelah record dibuat
            $paymentData = [
                'wilayah_id'             => $validated['wilayah_id'],
                'mitra_id'               => $validated['mitra_id'],
                'pengajuan_integrasi_id' => $validated['pengajuan_integrasi_id'],
                'jenis_pengajuan'        => $validated['jenis_pengajuan'],
                'cutoff'                 => $validated['cutoff'],
                'settlement'             => $validated['settlement'],
                'nomor_registrasi_legal' => $validated['nomor_registrasi_legal'],
                'fees_id'                => $fee->id,
                'pic_payment_mitra'      => $validated['pic_payment_mitra'],
                'telepon_payment_mitra'  => $validated['telepon_payment_mitra'],
                'pic_rekon_mitra'        => $validated['pic_rekon_mitra'],
                'telepon_rekon_mitra'    => $validated['telepon_rekon_mitra'],
                'pic_dinas'              => $validated['pic_dinas'],
                'telepon_dinas'          => $validated['telepon_dinas'],
                'transaksi_id'           => $validated['transaksi_id'],
                'wag_kordinasi_payment'  => $validated['wag_kordinasi_payment'],
                'wag_kordinasi_rekon'    => $validated['wag_kordinasi_rekon'],
                'mitra_agg'              => $validated['mitra_agg'],
                'jenis_pajak_id' => $jenisPajakStr,
                'user_id'                => Auth::id(),
                'kode_pengajuan'                => ''
            ];
            $payment = PaymentMba::create($paymentData);

            // Tentukan prefix berdasarkan ID user
            switch (Auth::id()) {
                case 2:
                    $prefix = 'AM1-';
                    break;
                case 3:
                    $prefix = 'AM2-';
                    break;
                case 4:
                    $prefix = 'AM3-';
                    break;
                case 5:
                    $prefix = 'AM4-';
                    break;
                case 6:
                    $prefix = 'AMK-';
                    break;
                default:
                    $prefix = 'AMK-';
                    break;
            }

            // Update PaymentMba dengan kode_pengajuan yang dibentuk dari prefix dan ID record
            $kode_pengajuan = $prefix . str_pad($payment->id, 5, '0', STR_PAD_LEFT);
            $payment->update(['kode_pengajuan' => $kode_pengajuan]);

            Log::info('Data PaymentMba berhasil disimpan.', ['payment_id' => $payment->id]);

            DB::commit();

            Session::flash('status', 'success');
            Session::flash('message', 'Data Berhasil Di Ajukan');
            return redirect('/admin/payment_mba_admin');

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("Terjadi kesalahan saat menyimpan data: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString(),
            ]);
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
