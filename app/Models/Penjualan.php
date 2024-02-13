<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table        = 'penjualan';
    protected $primaryKey   = 'penjualan_id';

    protected $fillable = [
        'kode_penjualan',
        'tgl_penjualan',
        'TotalHarga',
        'pelanggan_id',
    ];
}