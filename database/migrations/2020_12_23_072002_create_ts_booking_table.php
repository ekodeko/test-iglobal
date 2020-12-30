<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ts_booking', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nama_pasien', 254);
            $table->string('telepon', 13);
            $table->date('tanggal_lahir');
            $table->foreignId('id_dokter');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan', 0);
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
        Schema::dropIfExists('ts_booking');
    }
}
