<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("material_id")->nullable();
            $table->string("date");
            $table->bigInteger("begin_stock")->nullable();
            $table->bigInteger("total_stock")->nullable();
            $table->text('description')->nullable();

            $table->foreign("material_id")->references("id")->on("material");
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
        Schema::dropIfExists('inventory_material');
    }
}
