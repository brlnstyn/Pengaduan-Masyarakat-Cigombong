<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        $pending = Pengaduan::where('status', '0')->get()->count();
        $proses = Pengaduan::where('status', 'proses')->get()->count();
        $selesai = Pengaduan::where('status', 'selesai')->get()->count();
        $ditolak = Pengaduan::where('status', 'ditolak')->get()->count();
        return view('dashboard.index', [
            'pending' => $pending,
            'proses' => $proses,
            'selesai' => $selesai,
            'ditolak' => $ditolak,
        ]);
    }
}
