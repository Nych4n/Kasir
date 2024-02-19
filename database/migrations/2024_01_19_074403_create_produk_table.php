<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('produk_id');
            $table->string('kode_produk');
            $table->string('Namaproduk');
            $table->decimal('Harga', 10);
            $table->integer('Stok');
            $table->timestamps();
        });
        DB::table('produk')->insert([
            [ 'kode_produk' => 'A0001', 'Namaproduk' => 'Minyak Goreng' , 'Harga' => '15000' , 'Stok' => 15 ],
            [ 'kode_produk' => 'A0002', 'Namaproduk' => 'Sarden'        , 'Harga' => '20000' , 'Stok' => 35 ],
            [ 'kode_produk' => 'A0003', 'Namaproduk' => 'Gula 1kg'      , 'Harga' => '17000' , 'Stok' => 10 ],
            [ 'kode_produk' => 'A0004', 'Namaproduk' => 'Hilo Coklat'   , 'Harga' => '16000' , 'Stok' => 15 ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
