<?php

namespace App\Http\Controllers;

use App\Models\ditolak;
use App\Models\paymentmba;
use Illuminate\Http\Request;

class ditolakController extends Controller
{
    public function index()
    {
        $data['paymentmba'] = paymentmba::all();
        $data['ditolak'] = ditolak::all();


        return view('admin.ditolak',$data);
    }
}
