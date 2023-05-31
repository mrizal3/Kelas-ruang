<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('prodi_id')->constrained('prodis')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('matkul_id')->constrained('mata_kuliahs')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama', 100);
            $table->string('NIDN', 30);
            $table->string('no_hp', 13);
            $table->text('alamat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosens');
    }
}
