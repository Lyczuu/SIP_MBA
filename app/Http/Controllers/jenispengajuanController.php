<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jenispengajuanController extends Controller
{
    public function index()
    {
        return view('admin.jenispengajuan');
    }
}
