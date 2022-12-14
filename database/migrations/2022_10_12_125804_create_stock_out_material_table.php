<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("material_id")->nullable();
            $table->unsignedBigInteger("employee_id")->nullable();
            $table->bigInteger("material_outgoing");
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
        Schema::dropIfExists('stock_out_material');
    }
}
