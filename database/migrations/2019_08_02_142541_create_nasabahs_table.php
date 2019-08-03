<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNasabahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('nasabahs');
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('status');
            $table->string('istriSuami')->nullable();
            $table->string('pekerjaan');
            $table->string('telp');
            $table->text('alamat');
            $table->text('tanggalLahir');
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
        Schema::dropIfExists('nasabahs');
    }
}
