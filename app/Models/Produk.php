<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    
    protected $table        = 'produk';
    protected $primaryKey   = 'produk_id';

    protected $fillable = [
        'kode_produk',
        'Namaproduk',
        'Harga',
        'Stok',
    ];

    public static function generateKodeProduk()
    {
        return 'A' . date('ym') . str_pad(Produk::count() + 1, 3, '0', STR_PAD_LEFT);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'Pelanggan_id', 'id');
    }

    public function Detail()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

}