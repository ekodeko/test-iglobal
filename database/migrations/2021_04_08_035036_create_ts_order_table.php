<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('user_id')->constrained('users');;
            $table->enum('status', ['completed', 'processing', 'pending', 'refunded', 'cancelled']);
            $table->enum('payment_status', ['paid', 'unpaid']);
            $table->enum('payment_method', ['bank_transfer', 'cod']);
            $table->string('payment_info', 255)->nullable();
            $table->integer('discount');
            $table->integer('quantity');
            $table->string('bump', 255)->nullable();
            $table->integer('bump_price')->nullable();
            $table->string('notes', 255)->nullable();
            $table->string('courier', 255);
            $table->integer('shipping_cost');
            $table->integer('cod_cost')->nullable();
            $table->integer('shipping_markup')->nullable();
            $table->string('receipt_number', 255)->nullable();
            $table->integer('other_cost');
            $table->integer('gross_revenue');
            $table->integer('net_revenue');
            $table->timestamps();
            $table->timestamp('processing_at')->nullable()->default(null);
            $table->timestamp('completed_at')->nullable()->default(null);
            $table->timestamp('paid_at')->nullable()->default(null);
            $table->string('handled_by', 100)->nullable();
            $table->string('coupon', 100)->nullable();
            $table->string('utm_campaign', 255)->nullable();
            $table->string('utm_medium', 255)->nullable();
            $table->string('utm_source', 255)->nullable();
            $table->string('utm_content', 255)->nullable();
            $table->string('utm_term', 255)->nullable();
            $table->string('tags', 255)->nullable();
            $table->string('dropshipper_name', 255)->nullable();
            $table->string('dropshipper_phone', 20)->nullable();
            $table->string('variation', 200)->nullable();
            $table->string('original_code', 50)->nullable();
            $table->timestamp('imported_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ts_order');
    }
}
