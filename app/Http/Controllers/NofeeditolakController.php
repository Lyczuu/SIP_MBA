<?php

namespace App\Http\Controllers;

use App\Models\jenispajak;
use App\Models\paymentmba;
use App\Models\jenis_pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NofeeditolakController extends Controller
{
    public function index()
    {
        $allJenisPajak = jenispajak::pluck('nama_jenis_pajak', 'id'); // [id => nama]

        $paymentmba = PaymentMba::all()->map(function ($item) use ($allJenisPajak) {
            $jenisPajakIds = array_filter(array_map('trim', explode(',', $item->jenis_pajak_id ?? '')));
            $item->jenis_pajak_nama = collect($jenisPajakIds)
                ->map(fn($id) => $allJenisPajak[$id] ?? null)
                ->filter()
                ->implode(', ') ?: '-';
            return $item;
        });
        return view('admin.nofeeditolak',compact('paymentmba'));

    }
}
