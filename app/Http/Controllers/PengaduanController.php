<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PengaduanController extends Controller
{
    public function index()
    {
        // dd(Auth::guard('masyarakat')->user()->nik);
        $nik = Auth::guard('masyarakat')->user()->nik;
        $pengaduan = Pengaduan::where('nik', $nik)->get();
        return view('pengaduan.index', [
            'nik' => $nik,
            'pengaduan' => $pengaduan
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if ($image = $request->file('foto')) {
            // dd($image->getClientOriginalName());
            $destinationPath = 'storage/image';
            $fileName = date('YmdHis') . "." . $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            $input['foto'] = "$fileName";
        }
        // dd($input);
        Pengaduan::create($input);
        $requestId = Str::uuid();
        Log::channel('pengaduan')->info(json_encode([
            'id' => $requestId,
            'method' => 'buat pengaduan',
            'body' => $input,
        ]));
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dibuat!');
    }

    public function edit($id_pengaduan)
    {
        $pengaduan = Pengaduan::find($id_pengaduan);
        $nik = Auth::guard('masyarakat')->user()->nik;
        return view('pengaduan.edit', [
            'pengaduan' => $pengaduan,
            'nik' => $nik
        ]);
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $input = $request->all();
        if ($image = $request->file('foto')) {
            // dd($image->getClientOriginalName());
            $destinationPath = 'storage/image';
            $fileName = date('YmdHis') . "." . $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            $input['foto'] = "$fileName";
        } else {
            unset($input['foto']);
        }
        $requestId = Str::uuid();
        Log::channel('pengaduan')->info(json_encode([
            'id' => $requestId,
            'method' => 'update pengaduan',
            'body' => $input,
        ]));
        $pengaduan->update($input);
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diedit!');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if($pengaduan->status == 'ditolak')
        {
            $pengaduan->delete();
            $requestId = Str::uuid();
            Log::channel('pengaduan')->info(json_encode([
                'id' => $requestId,
                'method' => 'delete pengaduan',
                'nik' => Auth::guard('masyarakat')->user()->nik
            ]));
            return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
        }else{
            return redirect()->route('pengaduan.index')->with('error', 'Pengaduan tidak dapat dihapus!');
        }
    }

    public function show($id_pengaduan)
    {
        $nik = Auth::guard('masyarakat')->user()->nik;
        $pengaduan = Pengaduan::find($id_pengaduan);
        // dd($pengaduan);
        return view('pengaduan.show', [
            'nik' => $nik,
            'pengaduan' => $pengaduan
        ]);
    }

    public function kirimTanggapan($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();
        $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();
        return view('tanggapan.show', [
            'pengaduan' => $pengaduan,
            'tanggapan' => $tanggapan
        ]);
    }
}
