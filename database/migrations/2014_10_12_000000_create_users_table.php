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

        DB::table('users')->insert([
            [ 'name' => 'Admin', 'email' => 'admin@gmail.com' , 'password' =>  bcrypt('admin123') , 'level' => 'admin' ],
            [ 'name' => 'User', 'email' => 'user@gmail.com'        , 'password' =>  bcrypt('admin123') , 'level' => 'user' ],
        ]);

        // DB::table('users')->insert(array(
        //     'name' => 'Devina Urohmani',
        //     'email' => "devina@gmail.com",
        //     'password' => bcrypt('admin123'),
        //     'level' => 'admin'
        // ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};