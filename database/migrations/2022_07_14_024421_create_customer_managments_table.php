<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerManagmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_managments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_image');
            $table->string('shop_owner_name');
            $table->string('supermarket_name');
            $table->string('address');
            $table->string('mobile');
            $table->string('email');
            $table->string('total_point');
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
        Schema::dropIfExists('customer_managments');
    }
}
