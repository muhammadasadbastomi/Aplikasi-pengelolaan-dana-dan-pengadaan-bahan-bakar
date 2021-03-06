<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekTransmisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_transmisis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('uuid')->nullable();
            $table->string('kode_transmisi')->length(20);
            $table->string('jenis')->length(50);
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
        Schema::dropIfExists('objek_transmisis');
    }
}
