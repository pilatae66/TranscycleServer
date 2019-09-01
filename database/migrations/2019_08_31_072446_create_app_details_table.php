<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchased_product_id');
            $table->foreign('purchased_product_id')->references('id')->on('purchased_products')->onDelete('cascade')->onUpdate('cascade');
            $table->string('application_type');
            $table->string('customer_type');
            $table->string('requirements');
            $table->string('tin');
            $table->string('sss');
            $table->string('driver_license');
            $table->string('gsis');
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
        Schema::dropIfExists('app_details');
    }
}
