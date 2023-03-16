<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
       $username = Petugas::where('username', $data['username'])->first();
        if($username){
            return redirect()->back()->with('error', 'Username sudah terdaftar!');
        }else{
            $input = Petugas::create([
                'nama_petugas' => $data['nama_petugas'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'telp' => $data['telp'],
                'level' => $data['level']
            ]);
            $requestId = Str::uuid();
            Log::channel('register-petugas')->info(json_encode([
                'id' => $requestId,
                'body' => $input,
            ]));
            return redirect()->route('petugas.index')->with('success', 'Registrasi berhasil! Silahkan login!');
        }
    }

    public function destroy($id_petugas)
    {
        if(Auth::guard('admin')->user()->level == 'admin'){
            Petugas::where('id_petugas', $id_petugas)->delete();
            $requestId = Str::uuid();
            Log::channel('delete-petugas')->info(json_encode([
                'id' => $requestId,
                'function' => 'Delete Petugas dengan id: ' . $id_petugas,
                'admin' => Auth::guard('admin')->user()->nama_petugas
            ]));
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
            $requestId = Str::uuid();
            Log::channel('login-petugas')->info(json_encode([
                'id' => $requestId,
                'body' => 'username:' . $request->username,
                'message' => 'Login berhasil!'
            ]));
            return redirect()->route('dashboard.index');
        }else{
            $requestId = Str::uuid();
            Log::channel('login-petugas')->info(json_encode([
                'id' => $requestId,
                'body' => 'username:' . $request->username,
                'message' => 'Login gagal!'
            ]));
            return redirect()->back()->with('error', 'Akun tidak terdaftar!');
        }
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect('admin');
    }
}
