<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Petugas;

class Tanggapan extends Model
{
    use HasFactory;
    protected $table = 'tbl_tanggapan';
    protected $primaryKey = 'id_tanggapan';
    protected $fillable = [
        'id_pengaduan',
        'tgl_tanggapan',
        'tanggapan',
        'tgl_selesai',
        'id_petugas'
    ];

    public function petugas()
    {
        return $this->hasOne(Petugas::class, 'id_petugas', 'id_petugas');
    }
}
