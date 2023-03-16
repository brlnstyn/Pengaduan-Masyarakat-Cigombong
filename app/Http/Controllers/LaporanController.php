<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use \PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function getLaporan(Request $request)
    {
        // dd($request);
        $from = $request->from . ' ' . '00:00:00';
        $to = $request->to . ' ' . '23:59:59';

        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();

        return view('laporan.index', ['pengaduan' => $pengaduan, 'from' => $from, 'to' => $to]);
    }

    public function cetakLaporan($from, $to)
    {
        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->whereIn('status', ['proses', 'selesai', 'ditolak'])->orderBy('tgl_pengaduan', 'DESC')->get();
        $pending = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->where('status', '0')->get()->count();
        $proses = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->where('status', 'proses')->get()->count();
        $selesai = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->where('status', 'selesai')->get()->count();
        $ditolak = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->where('status', 'ditolak')->get()->count();
        // dd($pending, $proses, $selesai, $ditolak);
        $requestId = Str::uuid();
        Log::channel('buat-laporan')->info(json_encode([
            'id' => $requestId,
            'method' => 'Membuat laporan',
            'body' => 'pembuat laporan: ' . Auth::guard('admin')->user()->nama_petugas,
        ]));
        // dd($pengaduan);
        $pdf = PDF::loadView('laporan.cetak', [
            'pengaduan' => $pengaduan,
            'pending' => $pending,
            'proses' => $proses,
            'selesai' => $selesai,
            'ditolak' => $ditolak,
            'from' => $from,
            'to' => $to
        ])->setPaper('a4', 'landscape');;
        return $pdf->download('laporan-pengaduan.pdf');
    }
}
