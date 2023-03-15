<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tanggapan;
use App\Models\Masyarakat;

class Pengaduan extends Model
{
    use HasFactory;
    protected $table = 'tbl_pengaduan';
    protected $primaryKey = 'id_pengaduan';
    protected $fillable = [
        'tgl_pengaduan',
        'nik',
        'isi_laporan',
        'foto',
        'status'
    ];

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function masyarakat()
    {
        return $this->hasOne(Masyarakat::class, 'nik', 'nik');
    }
}
