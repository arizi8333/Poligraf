<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetaillayanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detaillayanans', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('pemesanan_id')->length(20);
            $table->string('layanan_id')->length(5);
            $table->integer('jumlah_terperiksa');
            $table->timestamps();
        });

        Schema::table('detaillayanans', function (Blueprint $table) {
            $table->foreign('pemesanan_id')->references('id')->on('pemesanans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('layanan_id')->references('id')->on('layanans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detaillayanans');
    }
}
