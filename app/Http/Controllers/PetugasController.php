<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();
        return view('petugas.index',[
            'petugas' => $petugas
        ]);
    }

    public function store(Request $request)
    {
       $data = $request->all();
       Validator::validate($data, [
        'nama_petugas' => 'required',
        'username' => 'required',
        'password' => 'required',
        'telp' => 'required',
        'level' => 'required'
       ]);
       $input = Petugas::create([
        'nama_petugas' => $data['nama_petugas'],
        'username' => $data['username'],
        'password' => Hash::make($data['password']),
        'telp' => $data['telp'],
        'level' => $data['level']
       ]);
    //    dd($input);
       return redirect()->route('petugas.index')->with('success', 'Akun berhasil dibuat!');
    }

    public function destroy($id_petugas)
    {
        if(Auth::guard('admin')->user()->level == 'admin'){
            Petugas::where('id_petugas', $id_petugas)->delete();
            return redirect()->route('petugas.index')->with('success', 'Akun petugas berhasil dihapus!');
        }else{
            return redirect()->route('petugas.index')->with('error', 'Anda bukan admin!');
        }

    }

    public function loginAdmin()
    {
        return view('admin.login');
    }

    public function authAdmin(Request $request)
    {
        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->route('dashboard.index');
        }else{
            return redirect()->back()->with('error', 'Akun tidak terdaftar!');
        }
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect('admin');
    }
}
