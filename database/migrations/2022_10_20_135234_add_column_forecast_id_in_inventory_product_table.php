<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnForecastIdInInventoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_product', function (Blueprint $table) {
            $table->unsignedBigInteger('forecast_id')->nullable();

            $table->foreign('forecast_id')->references('id')->on('forcast')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_product', function (Blueprint $table) {
            //
        });
    }
}
