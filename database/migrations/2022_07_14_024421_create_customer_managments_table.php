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
            $table->string('customer_image')->nullable();
            $table->string('shop_owner_name')->nullable();
            $table->string('supermarket_name')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile');
            $table->string('email');
            $table->string('total_point')->nullable();
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');
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
