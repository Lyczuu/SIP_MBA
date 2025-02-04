<?php

namespace App\Http\Controllers;

use App\Models\fees;
use App\Models\mitra;
use App\Models\wilayah;
use App\Models\paymentmba;
use App\Models\jenis_pajak;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\paymentmbafee;
use App\Models\jenis_transaksi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentmbafeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['paymentmbafee'] = paymentmbafee::all();
        $data['wilayah'] = wilayah::all();
        $data['mitra'] = mitra::all();
        $data['jenis_pajak'] = jenis_pajak::all();
        $data['jenis_transaksi'] = jenis_transaksi::all();
        $data['fees'] = fees::all();

        return view('admin.payment_mba_no_fee_admin', $data);



    }
    public function showAlerts()
    {
        $wilayah = Wilayah::all();
        $mitra = mitra::all();
        $jenis_pajak = jenis_pajak::all();
        $jenis_transaksi = jenis_transaksi::all();
        $fees = fees::all();

        return view('admin.payment_mba_no_fee_admin',  compact('wilayah', 'mitra', 'jenis_pajak', 'jenis_transaksi', 'fees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $jenisPajak = jenis_pajak::all(); //tabel di model


        // Kirim data ke view
        return view('admin.payment_mba_no_fee_admin', compact('jenisPajak', 'jenis_transaksi'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cek ID user yang sedang login
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        Log::info('User ID:', ['user_id' => $userId]);

        // Tambahkan log awal untuk memantau proses
        Log::info('Memulai proses penyimpanan data.');

        // Tambahkan kode pengajuan ke request
        $latestPayment = PaymentMba::latest('id')->first();
        $kodePengajuan = 'AMK-' . str_pad(($latestPayment ? $latestPayment->id + 1 : 1), 5, '0', STR_PAD_LEFT);

        $request->merge([
            'Kode_pengajuan' => $kodePengajuan,
        ]);

        $validated = $request->validate([
            'wilayah_id' => 'required|integer|exists:wilayah,id',
            'mitra_agg' => 'nullable|string',
            'mitra_id' => 'required|integer|exists:mitra,id',
            'Kode_pengajuan' => 'required|string|max:255',
            'Pengajuan_integrasi' => 'required|string|in:Development,SIT',
            'jenis_pajak' => 'required|array|min:1',
            'jenis_pajak.*' => 'integer|exists:jenis_pajak,id',
            'transaksi_id' => 'required|integer|exists:jenis_transaksi,id',
            'Cutoff' => 'required|string|max:255',
            'Settlement' => 'required|string|max:255',
            'Nomor_Registrasi_Legal' => 'required|string|max:255',
            'PIC_Payment_Mitra' => 'required|string|max:255',
            'telepon_payment_mitra' => 'required|string',
            'PIC_Rekon_Mitra' => 'required|string|max:255',
            'telepon_rekon_mitra' => 'required|string',
            'PIC_Dinas' => 'required|string|max:255',
            'telepon_dinas' => 'required|string',
            'WAG_KORDINASI_PAYMENT' => 'required|string|max:255',
            'WAG_KORDINASI_REKON' => 'required|string|max:255',
            'fees' => 'nullable|numeric',
            'Fee_mba' => 'nullable|numeric',
            'Fee_mitra' => 'nullable|numeric',
        ]);

        // Log input yang diterima
        Log::info('Data request:', $request->all());

        // Log untuk memastikan mitra_agg terisi
        Log::info('Data mitra_agg:', ['mitra_agg' => $validated['mitra_agg']]);

        // Mengubah jenis_pajak menjadi JSON
        $validated['jenis_pajak'] = json_encode($validated['jenis_pajak']);

        DB::beginTransaction();
        try {
            // Simpan data ke tabel fees
            $fee = Fees::create([
                'Fee_mba' => $validated['Fee_mba'] ?? 0,
                'Fee_mitra' => $validated['Fee_mitra'] ?? 0,
                'fees' => $validated['fees'] ?? 0,
            ]);

            Log::info('Data Fees berhasil disimpan.', ['fee_id' => $fee->id]);
            //mengambil id sebelumnya
            $latestPayment = PaymentMba::latest('id')->first();
            $kodePengajuan = 'AM-' . str_pad(($latestPayment ? $latestPayment->id + 1 : 1), 5, '0', STR_PAD_LEFT);

            // Simpan data ke tabel payment_mba
            $payment = PaymentMba::create([
                'wilayah_id' => $validated['wilayah_id'],
                'mitra_id' => $validated['mitra_id'],
                'Kode_pengajuan' => $kodePengajuan,
                'Pengajuan_integrasi' => $validated['Pengajuan_integrasi'],
                'Cutoff' => $validated['Cutoff'],
                'Settlement' => $validated['Settlement'],
                'Nomor_Registrasi_Legal' => $validated['Nomor_Registrasi_Legal'],
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
                'fees_id' => $fee->id,
                'user_id' => $userId,
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
            $payment->update([
                'Kode_pengajuan' => $prefix . str_pad($payment->id, 5, '0', STR_PAD_LEFT),
            ]);
            Log::info('Request Data:', $request->all());


            Log::info('Data PaymentMba berhasil disimpan.', ['payment_id' => $payment->id]);

            DB::commit();
            return redirect()->route('berhasil.page')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("Terjadi kesalahan saat menyimpan data: {$e->getMessage()}", [
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(paymentmbafee $paymentmbafee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paymentmbafee $paymentmbafee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Validasi data
    $request->validate([
        'wilayah_id' => 'required',
        'mitra_id' => 'required',
        'Kode_pengajuan' => 'required',
        'Pengajuan_integrasi' => 'required',
        'mitra_agg' => 'required',
        'Cutoff' => 'required',
        'Settlement' => 'required',
        'Nomor_Registrasi_Legal' => 'required',
        'PIC_Payment_Mitra' => 'required',
        'telepon_payment_mitra' => 'required',
        'PIC_Rekon_Mitra' => 'required',
        'telepon_rekon_mitra' => 'required',
        'PIC_Dinas' => 'required',
        'telepon_dinas' => 'required',
        'transaksi_id' => 'required',
        'WAG_KORDINASI_PAYMENT' => 'required',
        'WAG_KORDINASI_REKON' => 'required',
        'jenis_pajak_id' => 'required',
        'fees_id' => 'required|exists:fees,id',
        'user_id' => 'required',
        'dokumen' => 'nullable|file|mimes:pdf,jpg,png|max:2048', // Validasi file opsional
    ]);

    // Mengambil data yang akan diupdate
    $paymentmba = PaymentMba::findOrFail($id);

    // Update data berdasarkan request
    $paymentmba->wilayah_id = $request->wilayah_id;
    $paymentmba->mitra_id = $request->mitra_id;
    $paymentmba->Kode_pengajuan = $request->Kode_pengajuan;
    $paymentmba->Pengajuan_integrasi = $request->Pengajuan_integrasi;
    $paymentmba->mitra_agg = $request->mitra_agg;
    $paymentmba->Cutoff = $request->Cutoff;
    $paymentmba->Settlement = $request->Settlement;
    $paymentmba->Nomor_Registrasi_Legal = $request->Nomor_Registrasi_Legal;
    $paymentmba->PIC_Payment_Mitra = $request->PIC_Payment_Mitra;
    $paymentmba->telepon_payment_mitra = $request->telepon_payment_mitra;
    $paymentmba->PIC_Rekon_Mitra = $request->PIC_Rekon_Mitra;
    $paymentmba->telepon_rekon_mitra = $request->telepon_rekon_mitra;
    $paymentmba->PIC_Dinas = $request->PIC_Dinas;
    $paymentmba->telepon_dinas = $request->telepon_dinas;
    $paymentmba->transaksi_id = $request->transaksi_id;
    $paymentmba->WAG_KORDINASI_PAYMENT = $request->WAG_KORDINASI_PAYMENT;
    $paymentmba->WAG_KORDINASI_REKON = $request->WAG_KORDINASI_REKON;
    $paymentmba->jenis_pajak_id = $request->jenis_pajak_id;
    $paymentmba->fees_id = $request->fees_id;
    $paymentmba->user_id = $request->user_id;


    // Simpan perubahan
    $paymentmba->save();

    // Set flash message
    Session::flash('status', 'success');
    Session::flash('message', 'Data berhasil diperbarui');

    // Redirect kembali ke halaman admin
    // return redirect('/admin/payment_mba_no_fee');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paymentmbafee $paymentmbafee)
    {
        //
    }
}
