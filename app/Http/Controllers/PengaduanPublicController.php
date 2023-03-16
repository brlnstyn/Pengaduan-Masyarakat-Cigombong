<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanPublicController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::where('akses', 'public')->get();
        return view('pengaduanPublic.index', [
            'pengaduan' => $pengaduan,
        ]);
    }
}
