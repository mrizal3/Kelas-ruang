<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_peminjamen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('peminjaman_id')->constrained('peminjamans')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_peminjamen');
    }
}
