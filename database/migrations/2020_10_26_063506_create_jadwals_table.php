<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('prodi_id')->constrained('prodis')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('matkul_id')->constrained('mata_kuliahs')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ruang_id')->constrained('ruangs')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('semester')->unsigned();
            $table->integer('sks')->unsigned();
            $table->text('keterangan')->nullable();
            $table->integer('hari')->unsigned();
            $table->time('jam_mulai');
            $table->time('jam_selesai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
}
