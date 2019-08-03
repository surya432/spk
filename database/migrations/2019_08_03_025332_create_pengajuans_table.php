<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pengajuans');
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nasabah_id');
            $table->integer('umur');
            $table->bigInteger('nilaiPengajuan');
            $table->string('perkerjaan');
            $table->bigInteger('nilaiJaminan');
            $table->integer('tenorPinjaman');
            $table->bigInteger('gaji');
            $table->integer('jaminan');
            $table->bigInteger('nilaiAsset');
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
        Schema::dropIfExists('pengajuans');
    }
}
