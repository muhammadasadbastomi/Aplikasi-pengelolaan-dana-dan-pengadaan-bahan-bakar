<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTransmisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_transmisis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('objek_transmisi_id');
            $table->unsignedbigInteger('kendaraan_id');
            $table->text('uuid')->nullable();
            $table->string('status')->length(20);
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
            $table->foreign('objek_transmisi_id')->references('id')->on('objek_transmisis')->onDelete('cascade');
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
        Schema::dropIfExists('status_transmisis');
    }
}
