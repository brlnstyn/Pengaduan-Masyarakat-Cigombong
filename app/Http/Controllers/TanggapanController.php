<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Pengaduan;

class TanggapanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::all();
        return view('tanggapan.index', [
            'pengaduan' => $pengaduan,
        ]);
    }


}
