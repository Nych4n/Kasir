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
        DB::table('produk')->insert(array(
            'kode_produk' => 'A0983',
            'Namaproduk' => 'Minyak Kita',
            'Harga' => "15000",
            'Stok' => 25
        ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
