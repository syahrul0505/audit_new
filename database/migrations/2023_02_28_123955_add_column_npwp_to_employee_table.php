<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNpwpToEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->string('npwp')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->bigInteger('no_hp')->nullable();
            $table->string('upload_ktp')->nullable();
            $table->string('upload_npwp')->nullable();
            $table->string('upload_cv')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee', function (Blueprint $table) {
            //
        });
    }
}
