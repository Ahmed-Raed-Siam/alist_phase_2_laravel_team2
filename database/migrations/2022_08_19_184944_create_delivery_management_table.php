<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_management', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('mobile');
            $table->float('evaluation')->nullable();
            $table->float('total_amount');
            $table->integer('status');

            $table->foreignId('order_id')->constrained('orders_products');
            $table->foreignId('driver_id')->constrained('delivery_drivers');

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
        Schema::dropIfExists('delivery_management');
    }
}
