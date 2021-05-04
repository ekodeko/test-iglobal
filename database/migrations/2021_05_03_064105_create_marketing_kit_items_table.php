<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingKitItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_kit_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marketing_kit_id')->constrained('marketing_kits');
            $table->string('title');
            $table->string('thumbnail')->nullable()->default('default_picture');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketing_kit_items');
    }
}
