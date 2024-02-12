<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('level')->default('user')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(array(
            'name' => 'Devina Urohmani',
            'email' => "devina@gmail.com",
            'password' => bcrypt('admin123'),
            'level' => 'admin'
        ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};