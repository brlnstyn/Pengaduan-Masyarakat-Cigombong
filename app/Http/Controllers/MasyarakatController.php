<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = Masyarakat::all();
        return view('masyarakat.index', [
            'masyarakat' => $masyarakat
        ]);
    }

    public function register()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Validator::validate($data, [
            'nik' => 'required',
            'nama' => 'required',
            'username' => 'required',
            'password' =>'required',
            'telp' => 'required'
        ]);
        $input = Masyarakat::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp']
        ]);
        // dd($input);
        return redirect('/login')->with('success', 'Registrasi berhasil! Silahkan login!');
    }

    public function login()
    {
        return view('login.index');
    }

    public function auth(Request $request)
    {
        if(Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->route('pengaduan.index');
        }else{
            return redirect()->back()->with('error', 'Akun tidak terdaftar!');
        }
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();
        return redirect('/login');
    }
}
