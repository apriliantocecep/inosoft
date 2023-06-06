<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tahun_keluaran',
        'warna',
        'harga',
        'mesin',
        'tipe_suspensi',
        'tipe_transmisi',
        'kapasitas_penumpang',
        'tipe',
        'jenis',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
