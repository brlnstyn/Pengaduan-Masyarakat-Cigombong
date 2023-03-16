<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TanggapanController extends Controller
{
    public function index()
    {
        $pengaduan = DB::table('tbl_pengaduan')->orderBy('created_at', 'DESC')->paginate(6);
        return view('tanggapan.index', [
            'pengaduan' => $pengaduan,
        ]);
    }

    public function cari(Request $request)
	{
		$cari = $request->cari;
        if($cari === 'pending')
        {
            $cari = "0";
            // dd($cari);
        }
        // dd($cari);
		$pengaduan = DB::table('tbl_pengaduan')
		->where('status','like',"%".$cari."%")
		->paginate();
        // dd($pengaduan);
		return view('tanggapan.index',['pengaduan' => $pengaduan]);

	}

    public function createOrUpdate(Request $request)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();
        $tanggapan = Tanggapan::where('id_pengaduan', $request->id_pengaduan)->first();
        if ($tanggapan) {
            $pengaduan->update([
                'status' => $request->status
            ]);
            if($request->status == 'selesai'){
                $tgl_selesai = date('Y-m-d');

            }
            $input = $tanggapan->update([
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan,
                'tgl_selesai' => $tgl_selesai,
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);
            $requestId = Str::uuid();
            Log::channel('tanggapan')->info(json_encode([
                'id' => $requestId,
                'method' => 'update tanggapan',
                'body' => 'tanggapan: ' . $request->tanggapan,
                'admin' => Auth::guard('admin')->user()->nama_petugas,
            ]));

            return redirect()->route('tanggapan.index', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['success' => 'Tanggapan berhasil dibuat!']);
        } else {
            $pengaduan->update(['status' => $request->status]);
            if($request->status == 'selesai'){
                $tgl_selesai = date('Y-m-d');
            }else{
                $tgl_selesai = null;
            }
            $tanggapan = Tanggapan::create([
                'id_pengaduan' => $request->id_pengaduan,
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan,
                'tgl_selesai' => $tgl_selesai,
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);
            $requestId = Str::uuid();
            Log::channel('tanggapan')->info(json_encode([
                'id' => $requestId,
                'method' => 'buat tanggapan',
                'body' => $tanggapan,
            ]));

            // dd($tanggapan);
            return redirect()->route('tanggapan.index', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['success' => 'Tanggapan berhasil dikirim!']);
        }
    }
}
