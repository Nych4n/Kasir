<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    
    protected $table        = 'pelanggan';
    protected $primaryKey   = 'Pelanggan_id';

    protected $fillable = [
        'nama',
        'Alamat',
        'NomorTelepon',
    ];
}