<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $table        = 'detail_penjualan';
    protected $primaryKey   = 'detail_id';

    protected $fillable = [
        'kode_penjualan',
        'produk_id',
        'jumlah',
        'subtotal',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'Pelanggan_id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}