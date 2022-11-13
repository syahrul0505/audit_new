<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorrPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendorr_pivot', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->unsigned()->nullable();
            $table->string('no_po')->unsigned()->nullable();
            $table->string('tanggal_po')->unsigned()->nullable();
            $table->string('no_invoice')->unsigned()->nullable();
            $table->string('tanggal_kirim')->unsigned()->nullable();

            $table->foreign('vendor_id')->references('id')->on('vendorr')->onDelete('cascade');
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
        Schema::dropIfExists('vendorr_pivot');
    }
}
