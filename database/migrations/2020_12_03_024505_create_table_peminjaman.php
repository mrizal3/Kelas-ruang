<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ruang_id')->constrained('ruangs')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->string('nomor', 50)->nullable();
            $table->string('perihal', 50)->nullable();
            $table->text('kepada');
            $table->dateTime('tanggal_dibuat');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->text('keterangan');
            $table->tinyInteger('status');
            $table->integer('jumlah_orang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjamans');
    }
}
