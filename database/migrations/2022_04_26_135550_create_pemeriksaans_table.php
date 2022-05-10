<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('id')->length(20)->primary();
            $table->string('pemesanan_id')->length(20);
            $table->string('layanan_id')->length(5);
            $table->string('user_id')->length(10);
            $table->string('case')->length(20);
            $table->string('nama_terperiksa')->length(25);
            $table->string('hasil');
            $table->integer('rating');
            $table->timestamps();
        });

        Schema::table('pemeriksaans', function (Blueprint $table) {
            $table->foreign('pemesanan_id')->references('id')->on('pemesanans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('layanan_id')->references('id')->on('layanans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaans');
    }
}
