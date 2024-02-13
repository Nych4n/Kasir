<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;
    
    protected $table        = 'pelanggan';
    protected $primaryKey = 'Pelanggan_id';

    protected $fillable = [
        'nama',
        'Alamat',
        'NomorTelepon',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'Pelanggan_id', 'Pelanggan_id');
    }
}