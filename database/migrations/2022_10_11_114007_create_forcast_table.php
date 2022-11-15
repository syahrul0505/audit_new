<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForcastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forcast', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id")->nullable();
            $table->unsignedBigInteger("employee_id")->nullable();
            $table->string("date");
            $table->bigInteger("qty");
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
        Schema::dropIfExists('forcast');
    }
}
