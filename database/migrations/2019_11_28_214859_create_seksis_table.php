<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('bidang_id');
            $table->text('uuid')->nullable();
            $table->string('kode_seksi')->length('25');
            $table->string('nama')->length(255);
            $table->foreign('bidang_id')->references('id')->on('bidangs')->onDelete('cascade');
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
        Schema::dropIfExists('seksis');
    }
}
