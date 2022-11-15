<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForcastProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forcast_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forecast_id')->nullable();
            $table->unsignedBigInteger('material_id')->nullable();
            $table->string('description')->nullable();

            $table->foreign('forecast_id')->references('id')->on('forcast')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('material')->onDelete('cascade');
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
        Schema::dropIfExists('forcast_product');
    }
}
