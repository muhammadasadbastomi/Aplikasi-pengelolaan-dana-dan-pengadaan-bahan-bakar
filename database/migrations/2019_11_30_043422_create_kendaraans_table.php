<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('uuid')->nullable();
            $table->unsignedbigInteger('karyawan_id');
            $table->string('nopol')->length(20);
            $table->string('merk')->length(100);
            $table->string('tipe')->length(50);
            $table->string('jenis')->length(50);
            $table->string('model')->length(50);
            $table->date('tahun_pembuatan');
            $table->string('isi_silinder')->length(10);
            $table->string('warna_kendaraan')->length(20);
            $table->string('bahan_bakar')->length(10);
            $table->string('warna_tnkb')->length(10);
            $table->date('tahun_registrasi');
            $table->string('no_mesin')->length(50);
            $table->string('no_bpkb')->length(50);
            $table->string('tercatat_kib')->length(10);
            $table->timestamps();
            $table->foreign('karyawan_id')->references('id')->on('karyawans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kendaraans');
    }
}
