<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mylea_production', function (Blueprint $table) {
            $table->id();
            $table->string('KodeProduksi');
            $table->date('TanggalProduksi');
            $table->string('JenisBaglog');
            $table->integer('JumlahBaglog');
            $table->string('Lokasi');
            $table->integer('Status');
            $table->integer('StatusHarvest');
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
        Schema::dropIfExists('mylea_production');
    }
}
