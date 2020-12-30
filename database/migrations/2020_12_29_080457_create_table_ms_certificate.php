<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMsCertificate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_certificate', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokter_id')->references('id')->on('ms_dokter')->onDelete('cascade');
            $table->string('certificate_number', 100)->unique();
            $table->softDeletes();
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
        Schema::dropIfExists('ms_certificate');
    }
}
