<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('id')->length(20)->primary();
            $table->string('user_id')->length(10);
            $table->string('diskon_id')->length(5);
            $table->string('bukti_pembayaran')->nullable();
            $table->integer('status');
            $table->integer('total_harga');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->time('jam_kadaluarsa');
            $table->time('jam_pembayaran')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::table('pemesanans', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('diskon_id')->references('id')->on('diskons')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanans');
    }
}
