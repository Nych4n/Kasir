<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $table        = 'detail_penjualan';
    protected $primaryKey   = 'detail_id';

    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'JumlahProduk',
        'Subtotal',
    ];
}