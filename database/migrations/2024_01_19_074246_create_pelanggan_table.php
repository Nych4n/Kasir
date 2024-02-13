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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('Pelanggan_id');
            $table->string('nama');
            $table->text('Alamat');
            $table->string('NomorTelepon', 15);
            $table->timestamps();
        });

        DB::table('pelanggan')->insert(array(
            'nama' => 'Juminten',
            'Alamat' => "Gondangrejo",
            'NomorTelepon' => "082877986547"
        ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
