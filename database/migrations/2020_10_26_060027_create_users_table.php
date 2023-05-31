<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fakultas_id')->constrained('fakultas')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('jabatan_id')->constrained('jabatans')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama');
            $table->string('username', 100);
            $table->string('password');
            $table->string('tipe_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
