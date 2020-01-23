<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRinciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rincians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('pencairan_id');
            $table->unsignedbigInteger('kendaraan_id');
            $table->text('uuid')->nullable();
            $table->string('nama_item');
            $table->integer('satuan');
            $table->double('harga_satuan');
            $table->double('volume');
            $table->double('total_harga_item');
            $table->date('tanggal_transaksi');
            $table->foreign('pencairan_id')->references('id')->on('pencairans')->onDelete('cascade');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rincians');
    }
}
