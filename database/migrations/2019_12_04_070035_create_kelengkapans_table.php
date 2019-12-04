<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelengkapansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelengkapans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('kendaraan_id');
            $table->unsignedbigInteger('item_kendaraan_id');
            $table->text('uuid')->nullable();
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
            $table->foreign('item_kendaraan_id')->references('id')->on('item_kendaraans')->onDelete('cascade');
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
        Schema::dropIfExists('kelengkapans');
    }
}
