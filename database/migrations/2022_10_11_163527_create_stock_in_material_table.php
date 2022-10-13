<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_in_material', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("material_id")->unsigned()->nullable();
            $table->bigInteger("employee_id")->unsigned()->nullable();
            $table->bigInteger("material_incoming");
            $table->string("date");
            $table->bigInteger("current_stock")->nullable();
            $table->text('description')->nullable();

            $table->foreign("material_id")->references("id")->on("material");
            $table->foreign("employee_id")->references("id")->on("employee");
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
        Schema::dropIfExists('stock_in_material');
    }
}
