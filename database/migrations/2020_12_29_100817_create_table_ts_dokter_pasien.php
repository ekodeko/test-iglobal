<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTsDokterPasien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ts_dokter_pasien', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('dokter_id')->unsigned()->references('id')->on('ms_dokter');
            $table->foreignId('user_id')->unsigned()->references('id')->on('users');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan');
            $table->text('pesan');
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
        Schema::dropIfExists('ts_dokter_pasien');
    }
}
