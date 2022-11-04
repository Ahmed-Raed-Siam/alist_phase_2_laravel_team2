<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->unsignedBigInteger('order_status_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->string('order_number')->nullable();
            $table->string('products_number')->nullable();
            $table->string('evaluation')->nullable();
            $table->string('total')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customer_managments')->onDelete('set null');
            $table->foreign('order_status_id')->references('id')->on('order_cases')->onDelete('set null');
            $table->foreign('driver_id')->references('id')->on('delivery_drivers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
