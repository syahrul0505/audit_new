<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("product_id")->unsigned()->nullable();
            $table->bigInteger("employee_id")->unsigned()->nullable();
            $table->bigInteger("product_outgoing");
            $table->bigInteger("current_stock")->nullable();
            $table->text('description')->nullable();

            $table->foreign("product_id")->references("id")->on("product");
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
        Schema::dropIfExists('stock_out_product');
    }
}
